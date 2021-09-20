# NASABAH ENDPOINT
<a href="../../README.md"><strong>« back to menu</strong></a>

<details open="open">
  <summary>Table of Contents</summary>
  <ul>
    <li><a href="#11-register">register</a></li>
    <li><a href="#12-verification">verification</a></li>
    <li><a href="#13-login">login</a></li>
    <li><a href="#14-session-check">session check</a></li>
    <li><a href="#15-get-data">get data</a></li>
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
    |email       | yes      | yes    | 8 char     | 20 char    | xxxx@gmail.com     |
    |username    | yes      | yes    | 8 char     | 20 char    |                    |
    |password    | yes      | -      | 8 char     | 20 char    |                    |
    |nama_lengkap| yes      | yes    | 6 char     | 40 char    |                    |
    |notelp      | yes      | yes    | 6 char     | 12 char    |0856xxxxxxxx        |
    |alamat      | yes      | -      | 10 char    | 255 char   |                    |
    |rt          | yes      | -      | 2 char     | 2 char     |01                  |
    |rw          | yes      | -      | 2 char     | 2 char     |02                  |
    |tgl_lahir   | yes      | -      | 11 char    | 16 char    |03-oktober-2000     |
    |kelamin     | yes      | -      | 9 char     | 9 char     |laki-laki/perempuan |

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
            "error": "1",
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
            "error": "1",
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
            "messages": {
                "code_otp": "code_otp is required"
            }
        }
      ```
    * **status :** 404 Not Found<br />
      **json :** 
      ```
        {
            "status": 400,
            "error": "1",
            "messages": {
                "code_otp": "otp not found"
            }
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

    | PARAMETER  | REQUIRED | MIN_LENGTH |
    | :--:       |  :--:    |  :--:      |
    |email       | yes      | 8 char     |
    |password    | yes      | 8 char     |

* **Success response**
    * **code :** 200 Ok<br />
      **json :** 
      ```
      {
            "status": 200,
            "error": false,
            "messages": "loggin success",
            "data": {
                "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1N..."
            }
      }
      ```
* **Error Response:**
    * **status :** 400 Bad Request<br />
      **json :** 
      ```
        {
            "status": 400,
            "error": "1",
            "messages": {
                "email": "email is required",
                "password": "password is required"
            }
        }
      ```
    * **status :** 404 Not Found<br />
      **json :** 
      ```
        {
            "status": 400,
            "error": "1",
            "messages": {
                "email": "email not found",
                "password": "password not match"
            }
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