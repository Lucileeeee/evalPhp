<?php
class ViewFooter implements AbstractController {   
    //METHOD
    public function displayView():string{
        ob_start();
?>
    </main>
    <footer>
        <p>footer</p>
    </footer>
</body>
</html>
<?php
        return ob_get_clean();
    }
}


