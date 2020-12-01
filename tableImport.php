<?
include 'vendor/autoload.php';
require_once "productsParams.php";


$file = $_FILES['importExcel'];

if (!empty($file['name'])) {
    $allowedExtension = array('xls', 'csv', 'xlsx');
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    if (in_array($extension, $allowedExtension)) {
        $fileName = uniqid() . '.' . $extension;
        move_uploaded_file($file['tmp_name'], "C:\Users\chern\OpenServer\OpenServer\domains\brain.force/" . $fileName);
        $fileType = PhpOffice\PhpSpreadsheet\IOFactory::identify($fileName);
        $reader = PhpOffice\PhpSpreadsheet\IOFactory::createReader($fileType);
        $spreadsheet = $reader->load($fileName);
        unlink($fileName);
        $data = $spreadsheet->getActiveSheet()->toArray();
        foreach ($data as $row) {
            $pdo = new PDO("mysql:host=127.0.0.1:3307;dbname=brainforce", "root", "root");
            $sql = "INSERT INTO `products` (`productName`, `price`, `wholesalePrice`, `availabilityInWarehouse1`, `availabilityInWarehouse2`, `countryOfOrigin`, `note`) VALUES (:productName, :price, :wholesalePrice, :availabilityInWarehouse1, :availabilityInWarehouse2, :countryOfOrigin, :note)";
            $statement = $pdo->prepare($sql);

            $statement->bindValue(':productName', $row[0]);
            $statement->bindValue(':price', $row[1]);
            $statement->bindValue(':wholesalePrice', $row[2]);
            $statement->bindValue(':availabilityInWarehouse1', $row[3]);
            $statement->bindValue(':availabilityInWarehouse2', $row[4]);
            $statement->bindValue(':countryOfOrigin', $row[5]);
            $statement->bindValue(':note', $row[6]);

            $statement->execute();
        }
        lowAmount();
        echo $message = 'Файл загружен!';
    } else {
        echo $message = 'Допустимые форматы: csv, xls, xlsx!';
    }
} else {
    echo $message = 'Вы не выбрали файл!';
}