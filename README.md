Table of Contents
=================
   * [Εγκατάσταση](#εγκατάσταση)
      * [Απαιτήσεις](#απαιτήσεις)
      * [Οδηγίες Εγκατάστασης](#οδηγίες-εγκατάστασης)
      * [Περιγραφή Παιχνιδιού](#περιγραφή-παιχνιδιού)
      * [Συντελεστές](#συντελεστές)
   * [Περιγραφή API](#περιγραφή-api)
      * [Methods](#methods)
         * [Login](#login)
         * [Register](#register)
         * [Leaderboard](#leaderboard)
         * [Board](#board)
         * [First](#first)
         * [Second](#second)
         * [Hands](#hands)
         * [Game](#game)
         * [Update](#update)
    


# Demo Page

Μπορείτε να κατεβάσετε τοπικά ή να επισκευτείτε την σελίδα : 
[https://users.iee.ihu.gr/~it185289/](https://users.iee.ihu.gr/~it185289/)



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


[Στυλιανός Ανδρέου](https://github.com/Lian48) : Σχεδιασμός mysql Βάσης Δεδομένων

[Χατζηπουργάνης Δημήτριος](https://github.com/dchatzip) : Σχεδίαση UI, Frontend

[Ραδής Τουμπαλίδης](https://github.com/radistoubalidis): Σχεδιασμός Frontend, PHP API

....

# Περιγραφή API

## Methods


### Login
```
POST /login 
json data
{
  login : 1
  "usernamePHP":"username",
  "passwordPHP":"password",
}
```
Αυθεντικοποιεί τον χρήστη και ξεκινά php session
### Register
```
POST /register
json data
{
  "usernamePHP":"username",
  "passwordPHP":"password",
  "emailPHP":"email"
}
```
Δημιουργεί νέο χρήστη
### Leaderboard
```
GET /leaderboard
```
Επιστρέφει τις νίκες και ήττες για κάθε χρήστη
### Board
```
GET /Board
```
Επιστρέφει ένα κενό πίνακα board
### First
```
POST /First
no json data
```
Εισάγει στην στήλη p1_id
### Second
```
POST /Second
no json data
```
Εισάγει στην στήλη p2_id
### Hands
```
POST /Hands
json data
{
  "p1_hand":"string",
  "p2_hand":"string",
  "p_turn" : int,
}
```
Δημιουργεί την τράπουλα και την χωρίζει στα δύο αποθηκεύοντας αντίστοιχα στις στήλες p1_hand και p2_hand
### Game
```
GET /Game
```
Επιστρέφει τον πίνακα board αφού έχει ξεκινήσει το παιχνίδι
### Update
```
POST /Update
json data
if end of game
{
    "new_p1_hand": "" || "KS",
    "new_p2_hand": "KS" | "",
    "new_p_turn" : null
}
if not end of game
{
  "new_p1_hand": "string",
    "new_p2_hand": "string",
    "new_p_turn" : int
}
```
Ανανεώνει τις τιμές στον πίνακα board και ελέγχει αν τελείωσε το παιχνίδι


## Entities


### Users
---------

Το board είναι ένας πίνακας, ο οποίος στο κάθε στοιχείο έχει τα παρακάτω:


| Attribute                | Description                                  | Values                              |
| ------------------------ | -------------------------------------------- | ----------------------------------- |
| `id`                     | Το προσωπικό id του κάθε χρήστη              | int                                |
| `username`               | ..                                           | varchar(255)                                |
| `password`               |  ..                                            | varchar(255)                          |
| `email`                  |    ..                                          | varchar(255)                       |
| `wins`                   | Νίκες του χρήστη            | int      |
| `losses`                 |           Ήττες του χρήστη                                  |      int                               |
|`loggedIn` | Περιγράφει αν είναι online ο χρήστης | enum('0','1') |


### Players
---------

O κάθε παίκτης έχει τα παρακάτω στοιχεία:


| Attribute                | Description                                  | Values                              |
| ------------------------ | -------------------------------------------- | ----------------------------------- |
| `game_id`               | Το προσωπικό id του κάθε παιχνιδιού                                 | int                              |
| `p1_hand`            | το χέρι του παίκτη 1 σε κάθε γύρο                | string array                             |
| `p1_id  `                | Το προσωπικό id του παίκτη 1 | int |
| `p2_hand`            | το χέρι του παίκτη 2 σε κάθε γύρο                | string array                             |
| `p2_id  `                | Το προσωπικό id του παίκτη 2 | int |
| `p_turn  `                | To id του παίκτη που έχει σειρά | int |
| `result  `                | To id του νικητή | default null enum('p1_id','p2_id) |


