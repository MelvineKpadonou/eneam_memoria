<?php

it('redirige la racine vers le catalogue', function () {
    $this->get('/')->assertRedirect(route('memoires.index'));
});
