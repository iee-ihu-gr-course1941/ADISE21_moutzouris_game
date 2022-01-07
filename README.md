Table of Contents
=================
   * [Εγκατάσταση](#εγκατάσταση)
      * [Απαιτήσεις](#απαιτήσεις)
      * [Οδηγίες Εγκατάστασης](#οδηγίες-εγκατάστασης)
      * [Περιγραφή Παιχνιδιού](#περιγραφή-παιχνιδιού)
   * [Περιγραφή API](#περιγραφή-api)
      * [Methods](#methods)
         * [Board](#board)
            * [Ανάγνωση Board](#ανάγνωση-board)
            * [Αρχικοποίηση Board](#αρχικοποίηση-board)
         * [Piece](#piece)
            * [Ανάγνωση Θέσης/Πιονιού](#ανάγνωση-θέσηςπιονιού)
            * [Μεταβολή Θέσης Πιονιού](#μεταβολή-θέσης-πιονιού)
         * [Player](#player)
            * [Ανάγνωση στοιχείων παίκτη](#ανάγνωση-στοιχείων-παίκτη)
            * [Καθορισμός στοιχείων παίκτη](#καθορισμός-στοιχείων-παίκτη)
         * [Status](#status)
            * [Ανάγνωση κατάστασης παιχνιδιού](#ανάγνωση-κατάστασης-παιχνιδιού)
      * [Entities](#entities)
         * [Board](#board-1)
         * [Players](#players)
         * [Game_status](#game_status)


# Demo Page

Μπορείτε να κατεβάσετε τοπικά ή να επισκευτείτε την σελίδα: 
https://users.iee.ihu.gr/~asidirop/adise21/Lectures21-chess/



# Εγκατάσταση

## Απαιτήσεις

* Apache2
* Mysql Server
* php

## Οδηγίες Εγκατάστασης

 * Κάντε clone το project σε κάποιον φάκελο <br/>
  `$ git clone https://github.com/iee-ihu-gr-course1941/ADISE21_moutzouris_game`

 * Βεβαιωθείτε ότι ο φάκελος είναι προσβάσιμος από τον Apache Server. πιθανόν να χρειαστεί να καθορίσετε τις παρακάτω ρυθμίσεις.

 * Θα πρέπει να δημιουργήσετε στην Mysql την βάση με όνομα 'moutz_tests' ή κάποιο όνομα της επιλογής σας και να φορτώσετε σε αυτήν την βάση τα δεδομένα από το αρχείο schema.sql

 * Θα πρέπει να φτιάξετε το αρχείο src/config/db.php το οποίο να περιέχει:
```
    <?php
      // $user = 'DB_username';
      // $passwd = 'DB_password';
    ?>
```

## Περιγραφή Παιχνιδιού

Ο μουτζούρης παίζεται ως εξής: Βγάζουμε όλες τις φιγούρες από την τράπουλα και αφήνουμε μόνο το 'K♠', έπειτα χωρίζουμε την τράπουλα διά τον αριθμό των παικτών και ξεκινάω το παιχνιδι.Σε κάθε γύρο ο παίκτης που είναι η σείρα του διαλέγει ένα φύλλο από τον παίκτη αριστερά του και αν υπάρχουν διπλά στα φύλλα του τα πετάει. Στο τέλος αυτός που μείνει με το φύλλο 'K♠' είναι ο χαμένος.

Η βάση μας κρατάει τους εξής πίνακες και στοιχεία :
> ### Πίνακας ***users*** ο οποίος αποθηκεύει :
> - `id` , ως primary key και auto_increment
> - `username`
> - `password` , χρησιμοποιώντας την build-in μέθοδο `sha1` της php για λόγους ασφάλειας
> - `email`,
> - `wins`, οι νίκες του παίκτη,
> - `losses`, οι ήττες του παίκτη,
> - `loggedIn`, που είναι τύπου `enum('0','1')` -> 0 αν ο χρήστης είναι offline και 1 αν ο χρήστης είναι online

> ### Πίνακας ***board*** ο οποίος αποθηκεύει :
> - `game_id` , ως primary key και auto_increment
> - `p1_hand` , τα φύλλα στο χέρι του πάικτη 1
> - `p1_id`, το user id του παίκτη 1
> - `p2_hand` , τα φύλλα στο χέρι του πάικτη 2
> - `p2_id`, το user id του παίκτη 2
> - `p_turn`, που είναι τύπου `enum('1','2')` -> 1 αν ε'ιναι η σειρά του παίκτης 1, 2 αν είναι η σειρά ου παίκτη 2,
> - `result` , με τιμή default null και παίρνει την τιμή του user id που κέρδισε

Η εφαρμογή απαπτύχθηκε μέχρι το σημείο .....(αναφέρετε τι υλοποιήσατε και τι όχι)

## Συντελεστές

Περιγράψτε τις αρμοδιότητες της ομάδας.

Προγραμματιστής 1: Jquery

Προγραμματιστής 2: PHP API

Προγραμματιστής 3: Σχεδιασμός mysql

....



