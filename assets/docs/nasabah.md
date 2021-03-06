# NASABAH ENDPOINT
<a href="../../README.md"><strong>« back to menu</strong></a>

<details open="open">
  <summary>Table of Contents</summary>
  <ul>
    <li><a href="#1-register">register</a></li>
    <li><a href="#2-verification">verification</a></li>
    <li><a href="#3-login">login</a></li>
    <li><a href="#4-session-check">session check</a></li>
    <li><a href="#5-get-profile">get profile</a></li>
    <li><a href="#6-get-saldo">get saldo</a></li>
    <li><a href="#7-edit-profile">edit profile</a></li>
    <li><a href="#8-logout">logout</a></li>
    <li><a href="#9-forgot-password">forgot password</a></li>
    <li><a href="#10-kritik-dan-saran">send kritik</a></li>
  </ul>
</details>

## 1 register
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
    |notelp      | yes      | yes    |            | 14 char    | **only number*     |
    |alamat      | yes      | -      |            | 255 char   |                    |
    |kodepos     | yes      | -      | 5 char     | 5 char     | **only number* |
    |rt          | yes      | -      | 2 char     | 2 char     | **only number* |
    |rw          | yes      | -      | 2 char     | 2 char     | **only number* |
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

## 2 verification
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

## 3 login
* **URL** <br>
    ```
    https://bsblbackend.herokuapp.com/nasabah/login
    ```
* **Request method** <br>
`POST`
* **Params body** <br>

    | PARAMETER  | REQUIRED | value   |
    | :--:       |  :--:    | :--:    |
    |email       | yes      |         |
    |password    | yes      |         |
    |rememberme  | -        | '1'/'0' |

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

## 4 session check
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

## 5 get profile
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

## 6 get saldo
* **URL** <br>
    ```
    https://bsblbackend.herokuapp.com/nasabah/getsaldo
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
                "saldo_uang": "..",
                "saldo_emas": "..",
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

## 7 edit profile
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
    |notelp       | yes      | yes    |            | 14 char    |**only number*      |
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

## 8 logout
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

## 9 forgot password
* **URL** <br>
    ```
    https://bsblbackend.herokuapp.com/nasabah/forgotpass
    ```
* **Request method** <br>
`POST`
* **Params body** <br>

    | PARAMETER | REQUIRED |
    | :--:      |  :--:    |
    |email      | yes      |

* **Success response**
    * **code :** 200 Ok<br />
      **json :** 
      ```
      {
        "status": 200,
        "error": false,
        "messages": "password telah terkirim"
      }
      ```
* **Error Response:**
    * **status :** 400 Bad Request<br />
      **json :** 
      ```
        {
            "status": 400,
            "error": true,
            "messages": "email tidak terdaftar"
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

## 10 kritik dan saran
* **URL** <br>
    ```
    https://bsblbackend.herokuapp.com/nasabah/sendkritik
    ```
* **Request method** <br>
`POST`
* **Params body** <br>

    | PARAMETER | REQUIRED |MIN_LENGTH | MAX_LENGTH |
    | :--:      |  :--:    |:--:       |  :--:      |
    |name       | yes      |           | 20 char    |
    |email      | yes      |           | 40 char    |
    |message    | yes      |           | -          |

* **Success response**
    * **code :** 201 Created<br />
      **json :** 
      ```
      {
        "status": 201,
        "error": false,
        "messages": "kritik dan saran successfully sent"
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
