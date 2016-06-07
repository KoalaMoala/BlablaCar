<?php

if (isset($page)) {
    if (isset($module)) {
        $this->load->view("$module/$page");
    } else {
        $this->load->view($page);
    }
}