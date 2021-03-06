<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QuestionVotes
 *
 * @author DRX
 */
class QuestionVotes extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Check whether the use has already voted
     * @param type $userId
     * @param type $qId
     * @param type $isUpVote
     * @return boolean
     */
    function hasUserVoted($userId, $qId, $isUpVote) {
        //$this->db->select('votedUserId','questId');
        $this->db->where(array('votedUserId' => $userId, 'questId' => $qId, 'isUpVote' => $isUpVote));
        $result = $this->db->get('question_votes');

        if (count($result->result()) === 0) {
            return false;
        }
        return true;
    }

    /**
     * Add a vote to the question
     * @param type $votedUserId
     * @param type $qId
     * @param type $isUpVote
     */
    function addVote($votedUserId, $qId, $isUpVote) {
        $this->db->where(array('votedUserId' => $votedUserId, 'questId' => $qId));
        $result = $this->db->get('question_votes');
        
        if (count($result->result()) === 0) {
           $this->db->insert('question_votes', array('votedUserId' => $votedUserId, 'questId' => $qId, 'isUpVote' => $isUpVote));
        }else{
            $data = array('isUpVote' => $isUpVote);
            $this->db->where(array('votedUserId' => $votedUserId, 'questId' => $qId));
            $this->db->update('question_votes', $data);
        }
    }
}

?>
