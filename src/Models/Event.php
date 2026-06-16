<?php

/**
 * Model Event - Fil d'actualité Digital Events
 * Ticket 2
 */

class Event {
    
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Récupère tous les événements à venir
     */
    public function getUpcomingEvents($limit = 20) {
        $sql = "SELECT * FROM events 
                WHERE date_start >= NOW() 
                ORDER BY date_start ASC 
                LIMIT :limit";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un événement par son ID
     */
    public function getEventById($id) {
        $stmt = $this->db->prepare("SELECT * FROM events WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Pour la homepage (événements mis en avant)
     */
    public function getHighlightedEvents($limit = 4) {
        return $this->getUpcomingEvents($limit);
    }
}