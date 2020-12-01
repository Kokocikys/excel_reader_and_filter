function getUrlParameter(url, parameter) {
    parameter = parameter.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    let regex = new RegExp('[\\?|&]' + parameter.toLowerCase() + '=([^&#]*)');
    let results = regex.exec('?' + url.toLowerCase().split('?')[1]);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
}

function setUrlParameter(url, key, value) {

    let baseUrl = url.split('?')[0],
        urlQueryString = '?' + url.split('?')[1],
        newParam = key + '=' + value,
        params = '?' + newParam;

    // If the "search" string exists, then build params from it
    if (urlQueryString) {
        let updateRegex = new RegExp('([\?&])' + key + '[^&]*');
        let removeRegex = new RegExp('([\?&])' + key + '=[^&;]+[&;]?');

        if (typeof value === 'undefined' || value === null || value === '') { // Remove param if value is empty
            params = urlQueryString.replace(removeRegex, "$1");
            params = params.replace(/[&;]$/, "");

        } else if (urlQueryString.match(updateRegex) !== null) { // If param exists already, update it
            params = urlQueryString.replace(updateRegex, "$1" + newParam);

        } else { // Otherwise, add it to end of query string
            params = urlQueryString + '&' + newParam;
        }
    }
    // no parameter was set so we don't need the question mark
    params = params === '?' ? '' : params;

    return baseUrl + params;
}

let pageSelect = document.getElementById('pageSelect');
let currentPage = getUrlParameter(window.location.href, 'page');

if (currentPage) {
    pageSelect.value = currentPage;
}

pageSelect.addEventListener('change', function (event) {
    let value = event.target.value;
    window.location.href = setUrlParameter(window.location.href, 'page', value);
});