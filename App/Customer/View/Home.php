<?php
namespace App\Customer\View;

class Home
{
    private $form = <<<FORM
<form action="customer/collage" method="post" xmlns="http://www.w3.org/1999/html">
    <label>Width: </label><input type="text" name="width" /><br>
    <label>Height:</label><input type="text" name="height" /><br>
    <input type="submit" value="submit" />
</form>
FORM;

    /**
     * Method renders a collage
     */
    public function render()
    {
        echo $this->form;
    }
}



