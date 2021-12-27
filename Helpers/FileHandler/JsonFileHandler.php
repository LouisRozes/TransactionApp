<?php
class JsonFileHandler implements IFileHandler{

    private $directory;
    public $fileName;

    function __construct($directory, $fileName){
        $this->directory = $directory;
        $this->fileName= $fileName;
    }

    function Create(){
        if(!file_exists($this->directory)){
            mkdir($this->directory,0777,true);
        }
    }

    function SaveFile($value)
    {
        $this->Create($this->directory);
        $path = $this->directory . "/" . $this->fileName .".json";
        
        $serializeData = json_encode($value);
        
        $file = fopen($path, "w+");
        fwrite($file,$serializeData);
        fclose($file);

        $this->Create($this->directory);
        $path2 = $this->directory . "/" . $this->fileName .".txt";
        
        $serializeData = serialize($value);
        
        $file = fopen($path2, "w+");
        fwrite($file,$serializeData);
        fclose($file);

        $this->Create($this->directory);
        $path2 = $this->directory . "/" . $this->fileName .".csv";
        
        $serializeData = serialize($value);
        
        $file = fopen($path2, "w+");
        fwrite($file,$serializeData);
        fclose($file);
    }

    function ReadFile(){
        $path = $this->directory . "/" . $this->fileName . ".json";
        if(file_exists($path))
        {
            $file = fopen($path, "r");
            $contents = fread($file, filesize($path));
            fclose($file);
            return json_decode($contents);
        }
        else{
            return false;
        }
    }
}
?>