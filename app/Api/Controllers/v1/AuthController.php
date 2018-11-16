<?php

namespace App\Api\Controllers\v1;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

/**
 * 用户相关的接口
 *
 * @Resource("Users", uri="/user")
 */
class AuthController extends BaseController {
    /**
     * 用户登录
     *
     * 用户登录成功返回 token
     *
     * @Post("/login")
     * @Versions({"v1"})
     * @Request("name=foo&password=bar")
     * @Parameters({
     *      @Parameter("name", description="用户名", default=1),
     *      @Parameter("password", description="密码", default=1)
     * })
     * @Transaction({
     *      @Response(200, body={"token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9yZWFkLnRlc3RcL2FwaVwvdXNlclwvbG9naW4iLCJpYXQiOjE1NDIzNTkxNTAsImV4cCI6MTU0MjM2Mjc1MCwibmJmIjoxNTQyMzU5MTUwLCJqdGkiOiJnWU5vZFU3WlZZenBaNXBNIiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.Jp6RC_md1MXdYphZs2XEiTYP6aoO1p-v2ljV3EpKCZA"}),
     *      @Response(401, body={"message": "invalid_credentials", "status_code": 401}),
     *      @Response(500, body={"message": "could_not_create_token", "status_code": 500})
     * })
     */
    public function login(Request $request) {
        $credentials = [
            "name" => $request->get('name'),
            'password' => $request->get('password')
        ];
        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->response->error("invalid_credentials", 401);
//                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return $this->response->error("could_not_create_token", 500);
//            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    /**
     * 用户注册
     *
     * 用户注册成功后返回 token
     *
     * @Post("/register")
     * @Versions({"v1"})
     * @Request("name=foo&password=bar&email=123@qq.com")
     * @Parameters({
     *      @Parameter("name", description="用户名", default=1),
     *      @Parameter("password", description="密码", default=1),
     *      @Parameter("email", description="邮箱", default=1),
     * })
     * @Response(200, body={"token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9yZWFkLnRlc3RcL2FwaVwvdXNlclwvbG9naW4iLCJpYXQiOjE1NDIzNTkxNTAsImV4cCI6MTU0MjM2Mjc1MCwibmJmIjoxNTQyMzU5MTUwLCJqdGkiOiJnWU5vZFU3WlZZenBaNXBNIiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.Jp6RC_md1MXdYphZs2XEiTYP6aoO1p-v2ljV3EpKCZA"}),
     */
    public function register(Request $request) {
        $newUser = [
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'password' => bcrypt($request->get('password')),
        ];

        $user = User::create($newUser);
        $token = JWTAuth::fromUser($user);

        return response()->json(compact('token'));
    }

    /**
     * 用户注册
     *
     * 用户注册成功后返回 token
     *
     * @Post("/register")
     * @Versions({"v1"})
     * @Request("name=foo&password=bar&email=123@qq.com")
     * @Parameters({
     *      @Parameter("name", description="用户名", default=1),
     *      @Parameter("password", description="密码", default=1),
     *      @Parameter("email", description="邮箱", default=1),
     * })
     * @Transaction({
     *      @Response(200, body={"token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9yZWFkLnRlc3RcL2FwaVwvdXNlclwvbG9naW4iLCJpYXQiOjE1NDIzNTkxNTAsImV4cCI6MTU0MjM2Mjc1MCwibmJmIjoxNTQyMzU5MTUwLCJqdGkiOiJnWU5vZFU3WlZZenBaNXBNIiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.Jp6RC_md1MXdYphZs2XEiTYP6aoO1p-v2ljV3EpKCZA"}),
     *      @Response(404, body={"message": "user_not_found", "status_code": 404}),
     *      @Response(401, body={"message": "token_expired|token_absent", "status_code": 401}),
     * })
     */
    public function profile() {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());

        }

        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }
}
