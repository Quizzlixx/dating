<?php
// requires
require_once('/home/klowgree/config-dating.php');
//require_once('config-dating.php');

/* Database Creation
CREATE TABLE `member` (
	`member_id` smallint(4) UNSIGNED NOT NULL AUTO_INCREMENT,
	`fname` varchar(20) NOT NULL,
	`lname` varchar(20) NOT NULL,
	`age` tinyint(3) NOT NULL,
	`gender` varchar(6) NULL,
	`phone` varchar(14) NOT NULL,
	`email` varchar(40) NOT NULL,
	`state` varchar(20) NULL,
	`seeking` varchar(20) NULL,
	`bio` text NULL,
	`premium` tinyint(1),
	`image` text null,
	PRIMARY KEY (`member_id`)
) Engine=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `interest` (
	`interest_id` smallint(4) UNSIGNED NOT NULL AUTO_INCREMENT,
	`interest` varchar(40) NULL,
	`type` varchar(7) NOT NULL,
	PRIMARY KEY (`interest_id`)
) Engine=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `member-interest` (
	`member_id` smallint(4) UNSIGNED NOT NULL,
	`interest_id` smallint(4) UNSIGNED NOT NULL,
	FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`),
	FOREIGN KEY (`interest_id`) REFERENCES `interest` (`interest_id`)
) Engine=InnoDB DEFAULT CHARSET=utf8;
 */

class DatingDatabase
{
    // PDO object
    private $_dbh;

    function __construct()
    {
        try {
            // create a new PDO connection
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
//            echo "Connected!";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

function connect()
{

}

function insertMember($member)
{
    // define query
    $sql = "INSERT INTO `member`(`fname`, `lname`, `age`, `gender`, `phone`, `email`, `state`, `seeking`, `bio`, 
                                `premium`) 
            VALUES (:fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :size, :vaccination, :pName, 
                    :species, :bio, :premium)";

    // prepare statement
    $statement = $this->_dbh->prepare($sql);

    // bind params
    $statement->bindParam(':fname', $member->getFName());
    $statement->bindParam(':lname', $member->getLName());
    $statement->bindParam(':age', $member->getAge());
    $statement->bindParam(':gender', $member->getGender());
    $statement->bindParam(':phone', $member->getPhone());
    $statement->bindParam(':email', $member->getEmail());
    $statement->bindParam(':state', $member->getState());
    $statement->bindParam(':seeking', $member->getSeeking());
    $statement->bindParam(':size', $member->getSize());
    $statement->bindParam(':vaccination', $member->getVaccination());
    $statement->bindParam(':pName', $member->getPName());
    $statement->bindParam(':species', $member->getSpecies());
    $statement->bindParam(':bio', $member->getBio());
    $statement->bindParam(':premium', $member->getPremium());
    // if picture was enabled
//    $statement->bindParam(':picture', $member->getPicture());

    // execute statement
    $statement->execute();

    // get last insert id
    $id = $this->_dbh->lastInsertId();

}

function getMembers()
{
    // define query
    $sql = "SELECT * FROM `member`
            ORDER BY lname, fname";

    // prepare statement
    $statement = $this->_dbh->prepare($sql);
    // bind parameters
    # no params to bind

    // execute
    $statement->execute();

    // return results
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getMember($member_id)
{
    // define query
    $sql = "SELECT * FROM `member`
            WHERE member_id = :id";

    // prepare statement
    $statement = $this->_dbh->prepare($sql);

    // bind parameters
    $statement->bindParam(':id', $member_id);

    // execute
    $statement->execute();

    // return results
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function getInterests($member_id)
{
    // define query
    $sql = "SELECT interest.interest
            FROM interest, member-interest, member
            WHERE interest.interest_id = member-interest.interest_id AND member.member_id = member-interest.member_id";

    // prepare statement
    $statement = $this->_dbh->prepare($sql);

    // bind parameters
    $statement->bindParams(':id', $member_id);

    // execute
    $statement->execute();

    // return results
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}