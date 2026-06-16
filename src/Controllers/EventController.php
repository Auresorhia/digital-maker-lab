<?php

/**
 * EventController - Gestion des événements
 * Ticket 3
 */

class EventController {
    
    private $eventModel;

    public function __construct($db) {
        $this->eventModel = new Event($db);
    }

    // Page liste des événements
    public function index() {
        $events = $this->eventModel->getUpcomingEvents(20);
        $title = "Événements - Digital Maker Lab";
        require_once __DIR__ . '/../Views/front/events/index.php';
    }

    // Page détail d'un événement
    public function show($id) {
        $event = $this->eventModel->getEventById($id);
        if (!$event) {
            echo "Événement non trouvé";
            exit;
        }
        $title = $event['title'];
        require_once __DIR__ . '/../Views/front/events/show.php';
    }

    // Pour la homepage
    public function getHighlightedEvents($limit = 4) {
        return $this->eventModel->getHighlightedEvents($limit);
    }
}