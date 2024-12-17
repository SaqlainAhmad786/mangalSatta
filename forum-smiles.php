<?php
function applyReplacements($text) {
    $replacements = [
        ".0." => "<img src='smiles/0.gif'>",
        ".1." => "<img src='smiles/1.gif'>",
        ".2." => "<img src='smiles/2.gif'>",
        ".3." => "<img src='smiles/3.gif'>",
        ".4." => "<img src='smiles/4.gif'>",
        ".5." => "<img src='smiles/5.gif'>",
        ".6." => "<img src='smiles/6.gif'>",
        ".7." => "<img src='smiles/7.gif'>",
        ".8." => "<img src='smiles/8.gif'>",
        ".9." => "<img src='smiles/9.gif'>",
        ".a." => "<img src='smiles/a.gif'>",
        ".b." => "<img src='smiles/b.gif'>",
        ".logo." => "<img src='smiles/mangal-sattaking.png' width='180'>",
        ".mm." => "<img src='smiles/mangal-murti.png' width='190'>",
        ".db." => "<img src='smiles/dl-bazaar.png' width='200'>",
        ".sg." => "<img src='smiles/shree-ganesh.png' width='180'>",
        ".fd." => "<img src='smiles/faridabad.png' width='190'>",
        ".gd." => "<img src='smiles/ghaziabad.png' width='200'>",
        ".gl." => "<img src='smiles/gali.png' width='140'>",
        ".ds." => "<img src='smiles/desawar.png' width='180'>",
        ".single." => "<img src='smiles/single.png' width='160'>",
        ".haruf." => "<img src='smiles/haruf.png' width='150'>",
        ".ander." => "<img src='smiles/ander.png' width='130'>",
        ".baher." => "<img src='smiles/baher.png' width='130'>",
        ".result." => "<img src='smiles/result.png' width='160'>",
        ".ps." => "<img src='smiles/pass.png' width='140'>",
        ".cong." => "<img src='smiles/congrats.gif' width='80'>",
        ".cong1." => "<img src='smiles/congratulation.gif'>",
        ".frbd." => "<img src='smiles/frbd.png'>",
        ".gzbd." => "<img src='smiles/gzbd.png'>",
        ".gali." => "<img src='smiles/gali1.png'>",
        ".dswr." => "<img src='smiles/dswr.png'>",
        ".5star." => "<img src='smiles/5star.png' width='100'>",
        ".baaz." => "<img src='smiles/baaz.png'>",
        ".boom." => "<img src='smiles/boom.gif'>",
        ".hi." => "<img src='smiles/hi.gif'>",
        ".jhula." => "<img src='smiles/jhula.gif'>",
        ".rose." => "<img src='smiles/rose.gif'>",
        ".*." => "<img src='smiles/star.gif'>",
        ".thanks." => "<img src='smiles/thanks.png' width='100'>",
        ".thankyou." => "<img src='smiles/thankyou.gif'>",
        ".winner." => "<img src='smiles/winner.png' width='90'>",
        ".xx." => "<img src='smiles/xx.gif'>",
        ".dhamaka." => "<img src='smiles/dhamaka.png' width='100'>",
        
    ];
    
    foreach ($replacements as $search => $replace) {
        $text = str_ireplace($search, $replace, $text);
    }
    
    return $text;
}
?>
