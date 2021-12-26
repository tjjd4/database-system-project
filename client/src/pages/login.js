import NavBar from '../components/navbar';
import React from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';

class Login extends React.Component {
    render() {
        return (
            <div>
                <NavBar />
                <h3>登入</h3>
                <div class="input">
                    <form class="login-form" method="POST" action="">
                        <input type="text" class="form-control" size="42" placeholder="帳號或使用者名稱" style={{margin: 10}}></input>

                        <input type="password" class="form-control" size="42" placeholder="密碼" style={{margin: 10}}></input>

                        <div>
                            <a href="#">忘記密碼?</a>
                        </div>

                        <br />
                        <script src='https://www.google.com/recaptcha/api.js'></script>

                        <div class="g-recaptcha col-10" data-sitekey="6LfmBmAaAAAAAA_3BKh2YkORKueHiUNS6BLu232e">
                        </div>


                        <div class="login-button" style={{padding: 20}}>
                            <input type="submit" class="btn btn-dark btn-md btn-login" id="login_button" size="30"
                                value="登入"></input>
                            <a href="#" onClick="javascript :history.back(1);"
                                class="btn btn-secondary btn-cancel ">取消</a>
                        </div>

                        <div class="login-register">
                            <p>還沒有帳號嗎?
                                <a href="register">趕快註冊一個!</a>
                            </p>
                        </div>
                        <div class="other-login">
                            <p>或是選用其他登入方式</p>
                            <div class="other-login-method">
                                <a href="#" class="btn btn-md btn-outline-secondary">
                                    &nbsp; 透過Google信箱進行登入
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        );
    }
}

export default Login;