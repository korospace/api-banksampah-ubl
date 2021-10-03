# NASABAH ENDPOINT
<a href="../../README.md"><strong>« back to menu</strong></a>

<details open="open">
  <summary>Table of Contents</summary>
  <ul>
    <li><a href="#11-register">register</a></li>
    <li><a href="#12-verification">verification</a></li>
    <li><a href="#13-login">login</a></li>
    <li><a href="#14-session-check">session check</a></li>
    <li><a href="#15-get-profile">get profile</a></li>
    <li><a href="#16-edit-profile">edit profile</a></li>
    <li><a href="#17-logout">logout</a></li>
  </ul>
</details>

## 1.1 register
* **URL** <br>
    ```
    https://bsblbackend.herokuapp.com/nasabah/register
    ```
* **Request method** <br>
`POST`
* **Params body** <br>

    | PARAMETER  | REQUIRED | UNIQUE | MIN_LENGTH | MAX_LENGTH | example            |
    | :--:       |  :--:    |  :--:  |  :--:      |  :--:      |  :--:              |
    |email       | yes      | yes    |            | 40 char    | xxxx@gmail.com     |
    |username    | yes      | yes    | 8 char     | 20 char    |                    |
    |password    | yes      | -      | 8 char     | 20 char    |                    |
    |nama_lengkap| yes      | yes    |            | 40 char    |                    |
    |notelp      | yes      | yes    |            | 14 char    |0856xxxxxxxxxx      |
    |alamat      | yes      | -      |            | 255 char   |                    |
    |rt          | yes      | -      | 2 char     | 2 char     |01                  |
    |rw          | yes      | -      | 2 char     | 2 char     |02                  |
    |tgl_lahir   | yes      | -      |            | 10 char    |03-10-2000          |
    |kelamin     | yes      | -      |            | 9 char     |laki-laki/perempuan |

* **Success response**
    * **code :** 201 Created<br />
      **json :** 
      ```
      {
        "status": 201,
        "error": false,
        "messages": "register success. please check your email"
      }
      ```
* **Error Response:**
    * **status :** 400 Bad Request<br />
      **json :** 
      ```
        {
            "status": 400,
            "error": true,
            "messages": {
                "email": "max 30 character",
                "username": "max 20 character",
                ..
                ..
                ..
            }
        }
      ```
    * **status :** 500 Internal Server Error<br />
      **json :** 
      ```
        {
            "status": 500,
            "error": true,
            "messages": "...."
        }
      ```

## 1.2 verification
* **URL** <br>
    ```
    https://bsblbackend.herokuapp.com/nasabah/verification
    ```
* **Request method** <br>
`POST`
* **Params body** <br>

    | PARAMETER  | REQUIRED | MIN_LENGTH | MAX_LENGTH | example  |
    | :--:       |  :--:    |  :--:      |  :--:      |  :--:    |
    |code_otp    | yes      | 6 char     | 6 char     | 389020   |

* **Success response**
    * **code :** 201 Created<br />
      **json :** 
      ```
      {
        "status": 201,
        "error": false,
        "messages": "verification success"
      }
      ```
* **Error Response:**
    * **status :** 400 Bad Request<br />
      **json :** 
      ```
        {
            "status": 400,
            "error": "1",
            "messages": "code_otp is required"
        }
      ```
    * **status :** 404 Not Found<br />
      **json :** 
      ```
        {
            "status": 400,
            "error": "1",
            "messages": "code otp notfound"
        }
      ```
    * **status :** 500 Internal Server Error<br />
      **json :** 
      ```
        {
            "status": 500,
            "error": "1",
            "messages": "...."
        }
      ```

## 1.3 login
* **URL** <br>
    ```
    https://bsblbackend.herokuapp.com/nasabah/login
    ```
* **Request method** <br>
`POST`
* **Params body** <br>

    | PARAMETER  | REQUIRED |
    | :--:       |  :--:    |
    |email       | yes      |
    |password    | yes      |

* **Success response**
    * **code :** 200 Ok<br />
      **json :** 
      ```
      {
            "status": 200,
            "error": false,
            "messages": "loggin success",
            "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1N..."
      }
      ```
* **Error Response:**
    * **status :** 400 Bad Request<br />
      **json :** 
      ```
        {
            "status": 400,
            "error": true,
            "messages": {
                "email": "email is required",
                "password": "password is required"
            }
        }
      ```
    * **status :** 401 Unauthorized<br />
      **json :** 
      ```
        {
          "status": 401,
          "error": true,
          "messages": "account is not verify"
        }
      ```
    * **status :** 404 Not Found<br />
      **json :** 
      ```
        {
            "status": 400,
            "error": true,
            "messages": "email not found/password not match"
        }
      ```
    * **status :** 500 Internal Server Error<br />
      **json :** 
      ```
        {
            "status": 500,
            "error": true,
            "messages": "...."
        }
      ```

## 1.4 session check
* **URL** <br>
    ```
    https://bsblbackend.herokuapp.com/nasabah/sessioncheck
    ```
* **Request method** <br>
`GET`
* **Params header** <br>

    | PARAMETER  | REQUIRED | 
    | :--:       |  :--:    | 
    |token       | yes      |

* **Success response**
    * **code :** 200 Ok<br />
      **json :** 
      ```
      {
            "status": 200,
            "error": false,
            "data": {
                "id": "614894350b520",
                "id_nasabah": "060400002",
                "expired": 3575
            }
      }
      ```
* **Error Response:**
    * **status :** 401 Unauthorized<br />
      **json :** 
      ```
        {
            "status": 401,
            "error": "1",
            "messages": "access denied/token expired/invalid token"
        }
      ```
    * **status :** 500 Internal Server Error<br />
      **json :** 
      ```
        {
            "status": 500,
            "error": "1",
            "messages": "...."
        }
      ```

## 1.5 get profile
* **URL** <br>
    ```
    https://bsblbackend.herokuapp.com/nasabah/getprofile
    ```
* **Request method** <br>
`GET`
* **Params header** <br>

    | PARAMETER  | REQUIRED | 
    | :--:       |  :--:    | 
    |token       | yes      |

* **Success response**
    * **code :** 200 Ok<br />
      **json :** 
      ```
      {
            "status": 200,
            "error": false,
            "data": {
                "id": "614894350b520",
                "id_nasabah": "060400002",
                ..
                ..
            }
      }
      ```
* **Error Response:**
    * **status :** 401 Unauthorized<br />
      **json :** 
      ```
        {
            "status": 401,
            "error": true,
            "messages": "access denied/token expired/invalid token"
        }
      ```
    * **status :** 404 Not found<br />
      **json :** 
      ```
        {
            "status": 404,
            "error": true,
            "messages": "profile nasabah with id $id notfound"
        }
      ```
    * **status :** 500 Internal Server Error<br />
      **json :** 
      ```
        {
            "status": 500,
            "error": true,
            "messages": "...."
        }
      ```

## 1.6 edit profile
* **URL** <br>
    ```
    https://bsblbackend.herokuapp.com/nasabah/editprofile
    ```
* **Request method** <br>
`PUT`
* **Params body** <br>

    | PARAMETER   | REQUIRED | UNIQUE | MIN_LENGTH | MAX_LENGTH | example            |
    | :--:        |  :--:    |  :--:  |  :--:      |  :--:      |  :--:              |
    |username     | yes      | yes    | 8 char     | 20 char    |                    |
    |nama_lengkap | yes      | yes    |            | 40 char    |                    |
    |notelp       | yes      | yes    |            | 14 char    |0856xxxxxxxxxx      |
    |alamat       | yes      | -      |            | 255 char   |                    |
    |tgl_lahir    | yes      | -      |            | 10 char    |03-10-2000          |
    |kelamin      | yes      | -      |            | 9 char     |laki-laki/perempuan |
    |new_password | -        | -      | 8 char     | 20 char    |-                   |
    |old_password | -        | -      | -          | -          |-                   |


* **Success response**
    * **code :** 201 Created<br />
      **json :** 
      ```
      {
        "status": 201,
        "error": false,
        "messages": "edit profile success/nothing updated"
      }
      ```
* **Error Response:**
    * **status :** 400 Bad Request<br />
      **json :** 
      ```
        {
            "status": 400,
            "error": true,
            "messages": {
                "email": "max 30 character",
                "username": "max 20 character",
                ..
                ..
                ..
            }
        }
      ```
    * **status :** 500 Internal Server Error<br />
      **json :** 
      ```
        {
            "status": 500,
            "error": true,
            "messages": "...."
        }
      ```

## 1.7 logout
* **URL** <br>
    ```
    https://bsblbackend.herokuapp.com/nasabah/logout
    ```
* **Request method** <br>
`DELETE`
* **Params header** <br>

    | PARAMETER  | REQUIRED | 
    | :--:       |  :--:    | 
    |token       | yes      |

* **Success response**
    * **code :** 200 Ok<br />
      **json :** 
      ```
      {
        "status": 200,
        "error": false,
        "messages": "logout success"
      }
      ```
* **Error Response:**
    * **status :** 401 Unauthorized<br />
      **json :** 
      ```
        {
            "status": 401,
            "error": "1",
            "messages": "access denied/token expired/invalid token"
        }
      ```
    * **status :** 404 Not found<br />
      **json :** 
      ```
        {
            "status": 401,
            "error": "1",
            "messages": "user not found"
        }
      ```
    * **status :** 500 Internal Server Error<br />
      **json :** 
      ```
        {
            "status": 500,
            "error": "1",
            "messages": "...."
        }
      ```