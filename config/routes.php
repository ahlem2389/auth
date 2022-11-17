<?php
get("/",["WelcomeController","index"]);
get("/edit/{id}",["WelcomeController","edit"]);
post("/create",["WelcomeController","create!"]);
