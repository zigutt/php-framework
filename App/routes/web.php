<?php
Router::get("user/{id}", 'Profile@showProfile');
Router::get("contact/{id}", 'Contact@drawContact');
Router::post("contact/{id}|sendFeedback", 'Contact@drawContact');