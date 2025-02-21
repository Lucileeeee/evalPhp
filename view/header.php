<?php

class ViewHeader implements AbstractController {   
    //METHOD
    public function displayView():string{
        ob_start();
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            <header>
                <nav>Navigation</nav>
            </header>
            <main>
<?php
        return ob_get_clean();
    }
}