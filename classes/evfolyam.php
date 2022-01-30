<?php
    include("tanulo.php");

    class Evfolyam {
        private $tanulok = array();
        private $filename;
        private $osztalyok = array();

        function __construct($fajl)
        {
            $this->filename = $fajl;
            $f = fopen($fajl,"r");
            //fgets($f);
            while (!feof($f))
            {
                $sor = fgets($f);
                if ($sor != "")
                {
                    //$this->tanulok[] = new Tanulo($sor);
                    $tanulo = new Tanulo($sor);
                    array_push($this->tanulok,$tanulo);
                    if (!in_array($tanulo->osztaly,$this->osztalyok))
                    {
                        array_push($this->osztalyok,$tanulo->osztaly);
                    }
                }
            }
            fclose($f);
        }

        function GetAll()
        {
            return $this->tanulok;
        }

        function GetAllJson()
        {
            return json_encode($this->tanulok);
        }

        function SearchByName($name)
        {
            foreach ($this->tanulok as $key => $egytanulo) {
                if ($egytanulo->nev == $name)
                    //return json_encode($egytanulo);
                    return $egytanulo;
            }
            return null;
        }

        function SearchBySubName($name)
        {
            $talatiHalmaz = array();
            foreach ($this->tanulok as $key => $egytanulo) {
                if (strpos($egytanulo->nev, $name) !== FALSE)
                    $talatiHalmaz[] = $egytanulo;
            }
            return $talatiHalmaz;
        }

        function Create($tanulo)
        {
            try {
                $f = fopen($this->filename,"a");
                fwrite($f,$tanulo->toString());
                fclose($f);
                $tanulok[] = $tanulo;    
            } catch (\Throwable $th) {
                return false;
            }
            return true;
        }

        function Update($tanulo)
        {
            foreach ($this->tanulok as $key => $egytanulo) {
                if ($tanulo->nev == $egytanulo->nev)
                {
                    $egytanulo->osztaly = $tanulo->osztaly;
                    $egytanulo->matematika = $tanulo->matematika;
                    $egytanulo->angol = $tanulo->angol;
                    $egytanulo->nemet = $tanulo->nemet;
                    $egytanulo->informatika = $tanulo->informatika;
                    break;
                }
            }
            $this->TanulokFajlba();
        }

        function Delete($tanulo)
        {
            $index = -1;
            for ($i=0; $i < count($this->tanulok); $i++) { 
                if ($this->tanulok[$i]->nev == $tanulo->nev)
                {
                    $index = $i;
                    break;
                }
            }
            if ($index != -1)
            {
                unset($this->tanulok[$index]);
                $this->TanulokFajlba();
            }
        }

        private function TanulokFajlba()
        {
            $f = fopen($this->filename,"w");
            foreach ($this->tanulok as $key => $egytanulo) {
                fwrite($f,$egytanulo->toString());
            }
            fclose($f);
        }

        public function Osztalyok()
        {
            return $this->osztalyok;
        }
    }
?>