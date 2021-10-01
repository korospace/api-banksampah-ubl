# NASABAH ENDPOINT
<a href="../../README.md"><strong>« back to menu</strong></a>

<details open="open">
  <summary>Table of Contents</summary>
  <ul>
    <li><a href="#1-login">login</a></li>
    <li><a href="#2-session-check">session check</a></li>
    <li><a href="#3-get-profile">get profile</a></li>
    <li><a href="#4-edit-profile">edit profile</a></li>
    <li><a href="#5-logout">logout</a></li>
    <li><a href="#6-get-nasabah">get nasabah</a></li>
    <li><a href="#7-add-nasabah">add nasabah</a></li>
    <li><a href="#8-edit-nasabah">edit nasabah</a></li>
    <li><a href="#9-delete-nasabah">delete nasabah</a></li>
    <li><a href="#10-get-admin">get admin</a></li>
    <li><a href="#11-add-admin">add admin</a></li>
    <li><a href="#12-edit-admin">edit admin</a></li>
    <li><a href="#13-delete-admin">delete admin</a></li>
  </ul>
</details>

## 1. Login
* **URL** <br>
    ```
    https://bsblbackend.herokuapp.com/admin/login
    ```
* **Request method** <br>
`POST`
* **Params body** <br>

    | PARAMETER  | REQUIRED |
    | :--:       |  :--:    |
    |username    | yes      |
    |password    | yes      |

* **Success response**
    * **code :** 201 Created<br />
      **json :** 
      ```
      {
        "status": 201,
        "error": false,
        "messages": "loggin success",
        "token   ": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ..."
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
                "username": "username is required",
                "password": "password is required"
            }
        }
      ```
    * **status :** 404 Not found<br />
      **json :** 
      ```
        {
            "status": 400,
            "error": true,
            "messages": {
                "username": "username notfound",
                "password": "password not match"
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

## 2. session check
* **URL** <br>
    ```
    https://bsblbackend.herokuapp.com/admin/sessioncheck
    ```
* **Request method** <br>
`GET`
* **Params header** <br>

    | PARAMETER  | REQUIRED |
    | :--:       |  :--:    |
    |token       | yes      |

* **Success response**
    * **code :** 200 OK<br />
      **json :** 
      ```
      {
        "status": 200,
        "error": false,
        "data": {
          "id": "..",
          "id_admin": "..",
          "privilege": "..",
          "expired": 2826
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
    * **status :** 500 Internal Server Error<br />
      **json :** 
      ```
        {
            "status": 500,
            "error": true,
            "messages": "...."
        }
      ```

## 3. get profile
* **URL** <br>
    ```
    https://bsblbackend.herokuapp.com/admin/getprofile
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
            "data ": {
              "id": "..",
              "id_admin": "..",
              "username": "..",
              "nama_lengkap": "..",
              "alamat": "..",
              "notelp": "..",
              "tgl_lahir": "..",
              "kelamin": "..",
              "created_at": ".."
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
    * **status :** 500 Internal Server Error<br />
      **json :** 
      ```
        {
            "status": 500,
            "error": true,
            "messages": "...."
        }
      ```

## 4. edit profile
* **URL** <br>
    ```
    https://bsblbackend.herokuapp.com/admin/editprofile
    ```
* **Request method** <br>
`PUT`
* **Params header** <br>

    | PARAMETER  | REQUIRED | 
    | :--:       |  :--:    | 
    |token       | yes      |
* **Params body** <br>

    | PARAMETER  | REQUIRED | UNIQUE | MIN_LENGTH | MAX_LENGTH | example            |
    | :--:       |  :--:    |  :--:  |  :--:      |  :--:      |  :--:              |
    |username    | yes      | yes    | 8 char     | 20 char    |                    |
    |new_password| -        | -      | 8 char     | 20 char    |                    |
    |old_password| -        | -      | 8 char     | 20 char    |                    |
    |nama_lengkap| yes      | yes    |            | 40 char    |                    |
    |notelp      | yes      | yes    |            | 14 char    |0856xxxxxxxxxx      |
    |alamat      | yes      | -      |            | 255 char   |                    |
    |tgl_lahir   | yes      | -      |            | -          |dd-mm-yyyy          |
    |kelamin     | yes      | -      |            | -          |laki-laki/perempuan |

* **Success response**
    * **code :** 201 Created<br />
      **json :** 
      ```
      {
            "status": 200,
            "error": false,
            "messages": "edit profile is success"
      }
      ```
* **Error Response:**
    * **status :** 400 Bad request<br />
      **json :** 
      ```
        {
            "status": 400,
            "error": true,
            "messages": {
              ...
              ...
            }
        }
      ```
    * **status :** 401 Unauthorized<br />
      **json :** 
      ```
        {
            "status": 401,
            "error": true,
            "messages": "access denied/token expired/invalid token"
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

## 5. logout
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
            "error": true,
            "messages": "access denied/token expired/invalid token"
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

## 6 get nasabah
* **URL** <br>
    ```
    // All nasabah
    https://bsblbackend.herokuapp.com/admin/getnasabah
    
    // Detail nasabah
    https://bsblbackend.herokuapp.com/admin/getnasabah?id_nasabah=:id_nasabah
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
            ..
            ..
            ..
        }
      }
      ```
* **Error Response:**
    * **status :** 404 Not found<br />
      **json :** 
      ```
        {
            "status": 400,
            "error": true,
            "messages": "...."
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

## 7. add nasabah
* **URL** <br>
    ```
    https://bsblbackend.herokuapp.com/admin/addnasabah
    ```
* **Request method** <br>
`POST`
* **Params header** <br>

    | PARAMETER  | REQUIRED | 
    | :--:       |  :--:    | 
    |token       | yes      |
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
    |tgl_lahir   | yes      | -      |            | 10 char    |dd-mm-yyyy          |
    |kelamin     | yes      | -      |            |            |laki-laki/perempuan |

* **Success response**
    * **code :** 201 Created<br />
      **json :** 
      ```
      {
        "status": 201,
        "error": false,
        "messages": "add new nasabah is success"
      }
      ```
* **Error Response:**
    * **status :** 400 Bad request<br />
      **json :** 
      ```
        {
            "status": 400,
            "error": true,
            "messages": {
              ...
              ...
            }
        }
      ```
    * **status :** 401 Unauthorized<br />
      **json :** 
      ```
        {
            "status": 401,
            "error": true,
            "messages": "access denied/token expired/invalid token"
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

## 8. edit nasabah
* **URL** <br>
    ```
    https://bsblbackend.herokuapp.com/admin/editnasabah
    ```
* **Request method** <br>
`PUT`
* **Params header** <br>

    | PARAMETER  | REQUIRED | 
    | :--:       |  :--:    | 
    |token       | yes      |
* **Params body** <br>

    | PARAMETER  | REQUIRED | UNIQUE | MIN_LENGTH | MAX_LENGTH | example            |
    | :--:       |  :--:    |  :--:  |  :--:      |  :--:      |  :--:              |
    |id          | yes      | -      |            |            |                    |
    |email       | yes      | yes    |            | 40 char    | xxxx@gmail.com     |
    |username    | yes      | yes    | 8 char     | 20 char    |                    |
    |new_password| -        | -      | 8 char     | 20 char    |                    |
    |nama_lengkap| yes      | yes    |            | 40 char    |                    |
    |notelp      | yes      | yes    |            | 14 char    |0856xxxxxxxxxx      |
    |alamat      | yes      | -      |            | 255 char   |                    |
    |tgl_lahir   | yes      | -      |            | 10 char    |dd-mm-yyyy          |
    |kelamin     | yes      | -      |            |            |laki-laki/perempuan |
    |is_verify   | yes      | -      |            |            |'1'/'0'             |

* **Success response**
    * **code :** 201 Created<br />
      **json :** 
      ```
      {
        "status": 201,
        "error": false,
        "messages": "edit nasabah with id {id} is success"
      }
      ```
* **Error Response:**
    * **status :** 400 Bad request<br />
      **json :** 
      ```
        {
            "status": 400,
            "error": true,
            "messages": {
              ...
              ...
            }
        }
      ```
    * **status :** 404 Not found<br />
      **json :** 
      ```
        {
            "status": 404,
            "error": true,
            "messages": "..."
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

## 9. delete nasabah
* **URL** <br>
    ```
    https://bsblbackend.herokuapp.com/admin/deletenasabah?id=:id
    ```
* **Request method** <br>
`DELETE`
* **Params header** <br>

    | PARAMETER  | REQUIRED |
    | :--:       |  :--:    |
    |token       | yes      |

* **Success response**
    * **code :** 201 Created<br />
      **json :** 
      ```
      {
        "status": 201,
        "error": false,
        "messages": "delete nasabah with id {id} is success"
      }
      ```
* **Error Response:**
    * **status :** 404 Not found<br />
      **json :** 
      ```
        {
            "status": 404,
            "error": true,
            "messages": "..."
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

## 10 get admin
* **URL** <br>
    ```
    // All admin
    https://bsblbackend.herokuapp.com/admin/getadmin
    
    // Detail admin
    https://bsblbackend.herokuapp.com/admin/getadmin?id_admin=:id_admin
    ```
* **Request method** <br>
`GET`
* **Params header** <br>

    | PARAMETER  | REQUIRED | info                       | 
    | :--:       |  :--:    |  :--:                      | 
    |token       | yes      | **only superadmin allowed* |

* **Success response**
    * **code :** 200 Ok<br />
      **json :** 
      ```
      {
        "status": 200,
        "error": false,
        "data": {
            ..
            ..
            ..
        }
      }
      ```
* **Error Response:**
    * **status :** 404 Not found<br />
      **json :** 
      ```
        {
            "status": 400,
            "error": true,
            "messages": "...."
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

## 11. add admin
* **URL** <br>
    ```
    https://bsblbackend.herokuapp.com/admin/addadmin
    ```
* **Request method** <br>
`POST`
* **Params header** <br>

    | PARAMETER  | REQUIRED | info                       | 
    | :--:       |  :--:    |  :--:                      | 
    |token       | yes      | **only superadmin allowed* |
* **Params body** <br>

    | PARAMETER  | REQUIRED | UNIQUE | MIN_LENGTH | MAX_LENGTH | example            |
    | :--:       |  :--:    |  :--:  |  :--:      |  :--:      |  :--:              |
    |username    | yes      | yes    | 8 char     | 20 char    |                    |
    |password    | yes      | -      | 8 char     | 20 char    |                    |
    |nama_lengkap| yes      | yes    |            | 40 char    |                    |
    |notelp      | yes      | yes    |            | 14 char    |0856xxxxxxxxxx      |
    |alamat      | yes      | -      |            | 255 char   |                    |
    |tgl_lahir   | yes      | -      |            | 10 char    |dd-mm-yyyy          |
    |kelamin     | yes      | -      |            |            |laki-laki/perempuan |
    |privilege   | yes      | -      |            |            |super/admin         |

* **Success response**
    * **code :** 201 Created<br />
      **json :** 
      ```
      {
        "status": 201,
        "error": false,
        "messages": "add new admin is success"
      }
      ```
* **Error Response:**
    * **status :** 400 Bad request<br />
      **json :** 
      ```
        {
            "status": 400,
            "error": true,
            "messages": {
              ...
              ...
            }
        }
      ```
    * **status :** 401 Unauthorized<br />
      **json :** 
      ```
        {
            "status": 401,
            "error": true,
            "messages": "access denied/token expired/invalid token"
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

## 12. edit admin
* **URL** <br>
    ```
    https://bsblbackend.herokuapp.com/admin/editadmin
    ```
* **Request method** <br>
`PUT`
* **Params header** <br>

    | PARAMETER  | REQUIRED | info                       | 
    | :--:       |  :--:    |  :--:                      | 
    |token       | yes      | **only superadmin allowed* |
* **Params body** <br>

    | PARAMETER  | REQUIRED | UNIQUE | MIN_LENGTH | MAX_LENGTH | example            |
    | :--:       |  :--:    |  :--:  |  :--:      |  :--:      |  :--:              |
    |username    | yes      | yes    | 8 char     | 20 char    |                    |
    |new_password| -        | -      | 8 char     | 20 char    |                    |
    |nama_lengkap| yes      | yes    |            | 40 char    |                    |
    |notelp      | yes      | yes    |            | 14 char    |0856xxxxxxxxxx      |
    |alamat      | yes      | -      |            | 255 char   |                    |
    |tgl_lahir   | yes      | -      |            | -          |dd-mm-yyyy          |
    |kelamin     | yes      | -      |            | -          |laki-laki/perempuan |
    |privilege   | yes      | -      |            |            |super/admin         |
    |active      | yes      | -      |            |            |'1'/'0'             |

* **Success response**
    * **code :** 201 Created<br />
      **json :** 
      ```
      {
            "status": 200,
            "error": false,
            "messages": "edit admin with id {id} is success"
      }
      ```
* **Error Response:**
    * **status :** 400 Bad request<br />
      **json :** 
      ```
        {
            "status": 400,
            "error": true,
            "messages": {
              ...
              ...
            }
        }
      ```
    * **status :** 401 Unauthorized<br />
      **json :** 
      ```
        {
            "status": 401,
            "error": true,
            "messages": "access denied/token expired/invalid token"
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

## 13. delete admin
* **URL** <br>
    ```
    https://bsblbackend.herokuapp.com/admin/deleteadmin?id=:id
    ```
* **Request method** <br>
`DELETE`
* **Params header** <br>

    | PARAMETER  | REQUIRED | info                       | 
    | :--:       |  :--:    |  :--:                      | 
    |token       | yes      | **only superadmin allowed* |

* **Success response**
    * **code :** 201 Created<br />
      **json :** 
      ```
      {
        "status": 201,
        "error": false,
        "messages": "delete admin with id {id} is success"
      }
      ```
* **Error Response:**
    * **status :** 404 Not found<br />
      **json :** 
      ```
        {
            "status": 404,
            "error": true,
            "messages": "..."
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