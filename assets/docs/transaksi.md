# TRANSAKSI ENDPOINT
<a href="../../README.md"><strong>« back to menu</strong></a>

<details open="open">
  <summary>Table of Contents</summary>
  <ul>
    <li><a href="#1-get-data">get data</a></li>
  </ul>
</details>

## 1. get data
* **URL** <br>
    ```
    // All Transaksi
    https://bsblbackend.herokuapp.com/transaksi/getdata
    
    // Detail Transaksi
    https://bsblbackend.herokuapp.com/transaksi/getdata?id_transaksi=:id_transaksi
    
    // Filter By id nasabah
    https://bsblbackend.herokuapp.com/transaksi/getdata?idnasabah=:idnasabah
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
