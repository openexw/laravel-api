FORMAT: 1A

# Users

# Users [/user]
用户相关的接口

## 用户登录 [POST /user/login]
用户登录成功返回 token

+ Parameters
    + name: (string, optional) - 用户名
        + Default: 1
    + password: (string, optional) - 密码
        + Default: 1

+ Request (application/json)
    + Body

            "name=foo&password=bar"

+ Response 200 (application/json)
    + Body

            {
                "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9yZWFkLnRlc3RcL2FwaVwvdXNlclwvbG9naW4iLCJpYXQiOjE1NDIzNTkxNTAsImV4cCI6MTU0MjM2Mjc1MCwibmJmIjoxNTQyMzU5MTUwLCJqdGkiOiJnWU5vZFU3WlZZenBaNXBNIiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.Jp6RC_md1MXdYphZs2XEiTYP6aoO1p-v2ljV3EpKCZA"
            }

+ Response 401 (application/json)
    + Body

            {
                "message": "invalid_credentials",
                "status_code": 401
            }

+ Response 500 (application/json)
    + Body

            {
                "message": "could_not_create_token",
                "status_code": 500
            }

## 用户注册 [POST /user/register]
用户注册成功后返回 token

+ Parameters
    + name: (string, optional) - 用户名
        + Default: 1
    + password: (string, optional) - 密码
        + Default: 1
    + email: (string, optional) - 邮箱
        + Default: 1

+ Request (application/json)
    + Body

            "name=foo&password=bar&email=123@qq.com"

+ Response 200 (application/json)
    + Body

            {
                "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9yZWFkLnRlc3RcL2FwaVwvdXNlclwvbG9naW4iLCJpYXQiOjE1NDIzNTkxNTAsImV4cCI6MTU0MjM2Mjc1MCwibmJmIjoxNTQyMzU5MTUwLCJqdGkiOiJnWU5vZFU3WlZZenBaNXBNIiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.Jp6RC_md1MXdYphZs2XEiTYP6aoO1p-v2ljV3EpKCZA"
            }

## 用户注册 [POST /user/register]
用户注册成功后返回 token

+ Parameters
    + name: (string, optional) - 用户名
        + Default: 1
    + password: (string, optional) - 密码
        + Default: 1
    + email: (string, optional) - 邮箱
        + Default: 1

+ Request (application/json)
    + Body

            "name=foo&password=bar&email=123@qq.com"

+ Response 200 (application/json)
    + Body

            {
                "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9yZWFkLnRlc3RcL2FwaVwvdXNlclwvbG9naW4iLCJpYXQiOjE1NDIzNTkxNTAsImV4cCI6MTU0MjM2Mjc1MCwibmJmIjoxNTQyMzU5MTUwLCJqdGkiOiJnWU5vZFU3WlZZenBaNXBNIiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.Jp6RC_md1MXdYphZs2XEiTYP6aoO1p-v2ljV3EpKCZA"
            }

+ Response 404 (application/json)
    + Body

            {
                "message": "user_not_found",
                "status_code": 404
            }

+ Response 401 (application/json)
    + Body

            {
                "message": "token_expired|token_absent",
                "status_code": 401
            }