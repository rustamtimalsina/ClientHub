<?php
test('visiting the homepage redirects to login', function () {
    $response = $this->get('/');

    $response->assertRedirect('/login');
});
