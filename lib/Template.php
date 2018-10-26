<?php
/*
//Gebruik van deze template class werkt als volgt:

//Stap 1: de template
//Maak een template bestand voor alle client-side scripts (html, css, javascript, e.d.)
//Deel deze op in secties door middel van: {->JouwSectie} Sectie {<-JouwSectie}
//Elke stuk script moet binnen een sectie vallen, teksten en scripts die buiten een sectie vallen worden door deze classe genegeerd
//Variabele waarden kunnen worden gedeclareerd met {JouwVariabele}

//Stap 2: php code
//voeg deze classe toe aan je script met: include ("pad_naar_templateClass/Template.php");
//definieer een nieuwe template classe en geef daarin gelijk het pad naar de template op, bijvoorbeeld:
//$template = new Template("path/to/template.inc");

//geef een variabel in de template een waarde met:
//$template->setMarker("JouwVariabele", $jouwWaarde);

//vervolgens hallen we een sectie op met aangevulde waarden d.m.v.:
//$content = $template->getSection("JouwSectie");

//het is tenslotte ook mogelijk om de sectie direct weer te geven met:
//$template->printSection("JouwSectie");
//de $template->getSection() functie is dan niet nodig
*/
class Template {
  const VERSION = "1.2.1";
  private $vars = array();
  private $sTemplate;
  private $sTemplateSection;

  public function __construct($file){
    //laad volledige template in de string $this->sTemplate
    $this->sTemplate = file_get_contents($file)or die("Fout: \"$file\" kon niet geopend worden!");
  }
  
  private function setSection($section){
    //haal een sectie uit de template met een regular expression
    $sPregPattern = "|\{->".$section."\}([\s\S]+)\{<-".$section."\}|";
    $sTemplate = $this->sTemplate; 
    $aTempHolder = array();
    
    $regResult = preg_match_all($sPregPattern, $sTemplate, $aTempHolder, PREG_SET_ORDER);
    
    //stop het resultaat (als dat er is) in de string $this->sTemplateSection
    if($regResult != FALSE && $regResult != 0 && isset($aTempHolder[0][1])){
      $this->sTemplateSection = $aTempHolder[0][1];
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function setVar($marker, $value) {
    //geef elke marker een waarde mee, andergezegd; geef een marker in de template een vervangende waarde
    //verzamel alle vervangende waardes in de array $this->vars
    $this->vars[$marker] = $value;
    return TRUE;
  }
  
  private function replaceVars() {
    //vervang elke marker met de waarde die eerder gegeven is
    foreach ($this->vars as $marker => $value){
      $marker = '{' . $marker . '}';
      $this->sTemplateSection = str_replace($marker, $value, $this->sTemplateSection);
    }
    return TRUE;
  }
  
  public function getSection($section) {
    //gebruik setSection om een sectie uit een template te halen
    //vul deze met waarden m.b.v. $this->replaceMarkers() en retourneer de sectie indien mogelijk
    if($this->setSection($section)) {
      $this->replaceVars();
      //variabelen legen na gebruik
      $this->vars = array();
      return $this->sTemplateSection;
    } else {
      return FALSE;
    }
  }
  
  public function printSection($section){
    //print de string die $this->getSection retourneert
    $resultSection = $this->getSection($section);
    if ($resultSection != FALSE){
      print $resultSection;
      return TRUE;  
    } else {
      return FALSE;
    }
  }
}
?>


