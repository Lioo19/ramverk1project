<?php
/**
 * Mount the controller onto a mountpoint.
 */
return [
    "routes" => [
        [
            "info" => "Me controller.",
            "mount" => "me",
            "handler" => "\Lioo19\Me\MeController",
        ],
    ]
];
