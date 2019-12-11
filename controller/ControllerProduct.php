<?php


class ControllerProduct
{
    private $data = array();
    private $title = "";

    public function contactUs(Request $request) {
        $this->title = "Contact Us";
    }
}