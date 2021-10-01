<p align="center">
  <a href="https://github.com/korospace/t-gadgetapi">
    <img src="assets/img/logo.png" alt="Logo" width="120">
  </a>

  <h1 align="center">Banksampah Budiluhur API</h1>
</p>

## Tools & Stack
- [x] codeigniter4
- [x] firebase/php-jwt
- [x] phpmailer
- [x] postgresql

## Endpoints <br>
- url structure: <br>
  ```
  https://bsblbackend.herokuapp.com/:controller/:method
  ```

- controllers AND methods:

  | CONTROLLER  | METHOD | Detail Usage |
  |    :--:     |  :---  |     :--:     |
  | nasabah     | <ul><li>- register</li><li>- verification</li><li>- login</li><li>- sessioncheck</li><li>- getdata</li><li>- editprofile</li><li>- logout</li></ul> | <a href="/assets/docs/nasabah.md">detail</a>
  | admin       | <ul><li>- login</li><li>- sessioncheck</li><li>- getprofile</li><li>- editprofile</li><li>- logout</li><li>- getnasabah</li><li>- addnasabah</li><li>- editnasabah</li><li>- deletenasabah</li><li>- getadmin</li><li>- addadmin</li><li>- editadmin</li><li>- deleteadmin</li></ul> | <a href="/assets/docs/admin.md">detail</a>
  |kategori berita| <ul><li>- additem</li><li>- getitem</li><li>- deleteitem</li></ul> | <a href="/assets/docs/kategori-berita.md">detail</a>