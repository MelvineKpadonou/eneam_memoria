<?php

test('the application redirects guests to the memoires catalog', function () {
    $this->get('/')->assertRedirect(route('memoires.index'));
});
