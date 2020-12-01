<?
for ($i = 0; $i < $numberOfPages = numberOfPages($limit)[0]; $i++) echo '<option value="', $i + 1, '">', $i + 1, '</option>';