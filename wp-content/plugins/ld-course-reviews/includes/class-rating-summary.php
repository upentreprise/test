<?php

/**
 * LDCR Review Summary
 * 
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

class LDCR_Rating_Summary {

	/**
	 * Stores all ratings
	 * @var array
	 */
	private $ratings = array();

	/**
	 * Total number of ratings
	 * @var integer
	 */
	private $total_count = 0;

	/**
	 * Total percent
	 * @var integer
	 */
	private $total_percent = 0;

    /**
     * 5 levels
     * @var integer
     */
    private $level = 0;

	/**
	 * Constructor
	 * @param int $course_id course id
	 */
    function __construct( $course_id = null ) {
    	$this->ratings = $this->get_ratings( $course_id );
    	$this->total_count = $this->get_total_count();
    }

    /**
     * Get all ratings of a course
     * @param  int $course_id  course id
     * @return array           ratings array
     */
    function get_ratings( $course_id ) {
    	global $wpdb;
		
		$query = $wpdb->prepare("
			SELECT pm2.meta_value
			FROM {$wpdb->prefix}posts p1
			INNER JOIN {$wpdb->prefix}postmeta pm1 on pm1.meta_key = '_ldcr_course_id' AND pm1.meta_value = p1.ID
			INNER JOIN {$wpdb->prefix}posts p2 on p2.ID = pm1.post_id AND p2.post_status = 'publish' AND p2.post_type = 'ldcr_review'
			INNER JOIN {$wpdb->prefix}postmeta pm2 on p2.ID = pm2.post_id AND pm2.meta_key = '_ldcr_rating' AND pm2.meta_value IS NOT NULL
			WHERE
			p1.id = %d
		", $course_id );

		$results = $wpdb->get_col( $query );

		return $results ? $results : array();
    }

    /**
     * Get total number of ratings
     * @return int
     */
    function get_total_count() {
    	return count( $this->ratings );
    }

    /**
     * Get average score
     * @return float
     */
    function get_average_score() {
    	if ( 0 !== $this->total_count ) {
    		$score = round( array_sum( $this->ratings ) / $this->total_count , 1 );
    	} else {
    		$score = 0;
    	}
    	return $score;
    }

    /**
     * Get total number of a rating based on score
     * @return int
     */
    function get_rating_count( $score ) {
		return count( array_filter( $this->ratings, function( $number ) use ( $score )  {
			return floor( $number ) == $score;
		}));
    }

    /**
     * Get percentage of a score
     * @return int percentage
     */
    function get_rating_percent( $score ) {
        $this->level ++;
    	$percent = $this->total_count !== 0 ? round( $this->get_rating_count( $score ) / $this->total_count, 2, PHP_ROUND_HALF_DOWN ) * 100 : 0;
        // Get the last percentage value from subtraction
    	if ( $this->level == 5 && $this->total_percent !== 0 ) {
    		$percent = 100 - $this->total_percent;
    	} else {
    		$this->total_percent += $percent;
    	}
    	return $percent;
    }
}