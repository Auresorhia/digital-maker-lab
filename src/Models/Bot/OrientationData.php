<?php

namespace Models\Bot;

class OrientationData
{
    public static function getProfiles(): array
    {
        return [
            new Profile(
                'web_development',
                'Développement web',
                'Description du profil développement web à compléter.'
            ),

            new Profile(
                'ui_ux_design',
                'Design UI/UX',
                'Description du profil design UI/UX à compléter.'
            ),

            new Profile(
                'digital_marketing',
                'Marketing digital',
                'Description du profil marketing digital à compléter.'
            ),

            new Profile(
                'communication',
                'Communication',
                'Description du profil communication à compléter.'
            ),

            new Profile(
                'project_management',
                'Gestion de projet',
                'Description du profil gestion de projet à compléter.'
            ),
        ];
    }

    public static function getQuestions(): array
    {
        return [
            new Question(
                'start',
                'Question de départ à compléter.',
                [
                    new Answer('Réponse orientée développement web', 'web_development', 'tech_1'),
                    new Answer('Réponse orientée design UI/UX', 'ui_ux_design', 'design_1'),
                    new Answer('Réponse orientée marketing digital', 'digital_marketing', 'marketing_1'),
                    new Answer('Réponse orientée communication', 'communication', 'communication_1'),
                    new Answer('Réponse orientée gestion de projet', 'project_management', 'project_1'),
                ]
            ),

            new Question(
                'tech_1',
                'Question technique à compléter.',
                [
                    new Answer('Réponse technique 1', 'web_development', 'common_1'),
                    new Answer('Réponse technique 2', 'web_development', 'common_1'),
                ]
            ),

            new Question(
                'design_1',
                'Question design à compléter.',
                [
                    new Answer('Réponse design 1', 'ui_ux_design', 'common_1'),
                    new Answer('Réponse design 2', 'ui_ux_design', 'common_1'),
                ]
            ),

            new Question(
                'marketing_1',
                'Question marketing à compléter.',
                [
                    new Answer('Réponse marketing 1', 'digital_marketing', 'common_1'),
                    new Answer('Réponse marketing 2', 'digital_marketing', 'common_1'),
                ]
            ),

            new Question(
                'communication_1',
                'Question communication à compléter.',
                [
                    new Answer('Réponse communication 1', 'communication', 'common_1'),
                    new Answer('Réponse communication 2', 'communication', 'common_1'),
                ]
            ),

            new Question(
                'project_1',
                'Question gestion de projet à compléter.',
                [
                    new Answer('Réponse gestion 1', 'project_management', 'common_1'),
                    new Answer('Réponse gestion 2', 'project_management', 'common_1'),
                ]
            ),

            new Question(
                'common_1',
                'Question commune à compléter.',
                [
                    new Answer('Réponse développement', 'web_development', 'common_2'),
                    new Answer('Réponse design', 'ui_ux_design', 'common_2'),
                    new Answer('Réponse marketing', 'digital_marketing', 'common_2'),
                    new Answer('Réponse communication', 'communication', 'common_2'),
                    new Answer('Réponse gestion', 'project_management', 'common_2'),
                ]
            ),

            new Question(
                'common_2',
                'Dernière question commune à compléter.',
                [
                    new Answer('Réponse développement', 'web_development', null),
                    new Answer('Réponse design', 'ui_ux_design', null),
                    new Answer('Réponse marketing', 'digital_marketing', null),
                    new Answer('Réponse communication', 'communication', null),
                    new Answer('Réponse gestion', 'project_management', null),
                ]
            ),
        ];
    }
}