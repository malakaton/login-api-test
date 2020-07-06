## Latostadora Authentication APP

### Installation setup

Requirements: 
    - "php": "^7.2.5"

Installation:
    - composer install (To install dependencies)
    - ./bin/phpunit (To download PHPUnit itself and make its classes available in your app)

### Description

We need to create a Login REST App authenticated via email and password. 

**Endpoint:** /login

- You have to create a service that will receive an email and a password.

- Users information are stored at a csv file in data/users.csv. Can be accessed through  UserRepository interface.

#### Requirements

- A user is blocked when fail to login 3 consecutive times.
- When login is succesfull, service has to return no response.


**Possible api responses:**

#### 1. Login successful
    Http Code: 200

#### 2. Login failed
    Http Code: 401
    
#### 3. User not found
    Http Code: 404

#### 4. User blocked
    Http Code: 403

### Execute tests

 ./bin/phpunit tests/


