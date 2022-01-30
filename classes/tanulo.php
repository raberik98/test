<?php
    class Tanulo{
        public $nev;
        public $osztaly;
        public $matematika;
        public $angol;
        public $nemet;
        public $informatika;

        function __construct($sor)
        {
            $adatok = explode(";",trim($sor));
            $this->nev = $adatok[0];
            $this->osztaly = $adatok[1];
            $this->matematika = $adatok[2];
            $this->angol = $adatok[3];
            $this->nemet = $adatok[4];
            $this->informatika = $adatok[5];
        }

        function toString()
        {
            return $this->nev.";".
                   $this->osztaly.";".
                   $this->matematika.";".
                   $this->angol.";".
                   $this->nemet.";".
                   $this->informatika."\n";
        }

        static function GetFields(){
            return array("Név","Osztály","Matematika","Angol","Német","Informatika");

        }
    }
?>