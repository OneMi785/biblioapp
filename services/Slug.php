<?php

/**
 * Service de gestion des slugs pour BiblioApp
 */

class Slug
{
    public string $input;

    // Méthode statique pour générer un slug
    public static function toSlug(string $input) {
        $slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $input));
        return $slug;
    }
}