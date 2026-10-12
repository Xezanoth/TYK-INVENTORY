<?php

it('redirects the home page to the custom login screen', function () {
    $response = $this->get('/');

    $response->assertRedirectToRoute('login');

    $this->get('/login')
        ->assertOk()
        ->assertSee('Sign in to your account');
});
