-- ============================================
-- Fichier SQL pour la fonctionnalité "Mot de passe oublié"
-- Date: 2026-06-09
-- ============================================
--
-- Ce fichier ajoute le support de la réinitialisation
-- de mot de passe par code à 4 chiffres envoyé par email.
--
-- À exécuter sur une base où la table `admins` existe déjà
-- (voir feature_login_admin.sql).
-- ============================================

-- NOTE: MySQL (MAMP) ne supporte pas "ADD COLUMN IF NOT EXISTS".
-- N'exécutez ces ALTER qu'une seule fois. Si une colonne existe déjà,
-- supprimez la ligne correspondante avant d'exécuter.

-- Ajout des colonnes de réinitialisation
-- reset_code : le code à 4 chiffres HASHÉ (jamais stocké en clair)
-- reset_expires : date d'expiration du code (10 minutes par défaut)
ALTER TABLE admins
    ADD COLUMN reset_code VARCHAR(255) NULL AFTER password,
    ADD COLUMN reset_expires DATETIME NULL AFTER reset_code;

-- ============================================
-- Requêtes de test (optionnelles)
-- ============================================
-- SELECT id, email, reset_code, reset_expires FROM admins;
