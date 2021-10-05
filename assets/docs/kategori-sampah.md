# KATEGORI SAMPAH ENDPOINT
<a href="../../README.md"><strong>« back to menu</strong></a>

<details open="open">
  <summary>Table of Contents</summary>
  <ul>
    <li><a href="#1-add-item">add item</a></li>
    <li><a href="#2-get-item">get item</a></li>
    <li><a href="#3-delete-item">delete item</a></li>
  </ul>
</details>

## 1. add item
* **URL** <br>
    ```
    https://bsblbackend.herokuapp.com/kategori_sampah/additem
    ```
* **Request method** <br>
`POST`
* **Params header** <br>

    | PARAMETER  | REQUIRED | info                       | 
    | :--:       |  :--:    |  :--:                      | 
    |token       | yes      | **only admin allowed*      |
* **Params body** <br>

    | PARAMETER   | REQUIRED | UNIQUE | MIN_LENGTH | MAX_LENGTH |
    | :--:        |  :--:    |  :--:  |  :--:      |  :--:      |
    |kategori_name| yes      | yes    |            | 40 char    |

* **Success response**
    * **code :** 201 Created<br />
      **json :** 
      ```
      {
        "status": 201,
        "error": false,
        "messages": "add new kategori is success"
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

## 2. get item
* **URL** <br>
    ```
    https://bsblbackend.herokuapp.com/kategori_berita/getitem
    ```
* **Request method** <br>
`GET`

* **Success response**
    * **code :** 200 Created<br />
      **json :** 
      ```
      {
        "status": 200,
        "error": false,
        "data": {
          ..
          ..
        }
      }
      ```
* **Error Response:**
    * **status :** 404 Not Found<br />
      **json :** 
      ```
        {
            "status": 404,
            "error": true,
            "messages": ".."
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

## 3 delete item
* **URL** <br>
    ```
    https://bsblbackend.herokuapp.com/kategori_berita/deleteitem?id=:id
    ```
* **Request method** <br>
`DELETE`
* **Params body** <br>

    | PARAMETER  | REQUIRED | info                       | 
    | :--:       |  :--:    |  :--:                      | 
    |token       | yes      | **only admin allowed*      |

* **Success response**
    * **code :** 201 Created<br />
      **json :** 
      ```
      {
            "status": 201,
            "error": false,
            "messages": "delete kategori with id {id} is success",
      }
      ```
* **Error Response:**
    * **status :** 400 Bad request<br />
      **json :** 
      ```
        {
            "status": 400,
            "error": true,
            "messages": ".."
        }
      ```
    * **status :** 404 Not Found<br />
      **json :** 
      ```
        {
            "status": 404,
            "error": true,
            "messages": ".."
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