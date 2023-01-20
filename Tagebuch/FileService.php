<?php
class FileService{
    private string $directory;

    public function __construct(string $directory)
    {
        $this->directory = $directory;
    }


    /** Es wird geprüft, ob der Ordner vorhanden ist */
    public function checkDir(): void
    {
//  Wenn der Ordner nicht vorhanden ist, dann wird er erstellt
        if (!is_dir($this->directory)) {
            mkdir($this->directory);
        }
    }

    public function readFolder(): array
    {
//        $files ist ein leeres array
        $files = array();

//        Der Ordner "./Tage" wird durch gescannt
        foreach (scandir($this->directory) as $filename) {
            if ($filename !== '.' && $filename !== '..') {

//          für jede Datei wird der Inhalt ausgelesen
                $fileContent = $this->readContent($filename);

//                Die Namen mit dem zugehörigen Inhalt werden in einem Array gespeichert
                $files[$filename] = $fileContent;
            }
        }
//        Key und Value (Name und Inhalt) werden getauscht, um nach value sortiert zu werden
//        TODO: fix sorting
//        $files = array_flip($files);
//        natsort($files);
//        return array_flip($files);
        return $files;
    }

    private function readContent($filename): array
    {

        $myFile = fopen($this->directory . "/" . $filename, "r");

        $lineContent = [];
        while (!feof($myFile)) {
            $line = fgets($myFile);
            if ($line != ''){
                $lineContent[] = $line;
            }
        }
        fclose($myFile);
        return $lineContent;
    }

    public function cleanUpFileName(string $filename): string
    {
        return basename($filename, '.txt');
    }

    /**
     * Der Stichpunkt, welcher im Formular im Textfeld eingegeben wird,
     * wird in der zugehörigen Datei hinzugefügt
     */
    public function write($day, $content): void
    {
        $dayTwoChars = str_pad($day,2, "0", STR_PAD_LEFT);

//    Die Datei im Ordner "./Tage" wird mit dem zugehörigen Tagesnamen geöffnet.
        $myFile = fopen($this->directory . '/' . $dayTwoChars . '.txt', "a");

//    Zeilenumbrüche im Stichpunkt mit # austauschen
        $replacedContent = str_replace(PHP_EOL, '#', $content);

//    Die Datei wird beschrieben mit dem eingegebenen Text und endet mit auf einer neuen Zeile
        fwrite($myFile, $replacedContent . PHP_EOL);
        fclose($myFile);
    }
}