<template>
  <div class="login">
    <div class="cont">
      <div class="form sign-in">
        <h2 class="headerText">Welcome back,</h2>
        <label>
          <input type="email" placeholder="Email" v-model="email" class="formInputField" />
        </label>
        <label>
          <input type="password" placeholder="Password" v-model="password" class="formInputField" />
        </label>
        <p class="forgot-pass">Forgot password?</p>
        <button type="button" class="submit" @click="loginProcess">Sign In</button>
        <button type="button" class="fb-btn">
          Connect with
          <span>facebook</span>
        </button>
      </div>
      <div class="sub-cont">
        <div class="img">
          <div class="img__text m--up">
            <h2>New here?</h2>
            <p class="advertText">Sign up to utilize the Medical Equipment Management System</p>
          </div>
          <div class="img__text m--in">
            <h2>One of us?</h2>
            <p class="advertText">If you already have an account, just sign in. We've missed you!</p>
          </div>
          <div class="img__btn">
            <span class="m--up mpn">Sign Up</span>
            <span class="m--in mpn">Sign In</span>
          </div>
        </div>
        <div class="form sign-up">
          <h2 class="headerText">Time to feel like home,</h2>
          <label>
            <input type="email" class="formInputField" placeholder="Email" />
          </label>
          <label>
            <input type="password" class="formInputField" placeholder="Password" />
          </label>
          <label>
            <select class="chooseDept">
              <option value>Choose a department</option>
              <option value>Laboratory</option>
              <option value>Theatre</option>
              <option value>ICU</option>
              <option value>Pathology</option>
              <option value>Radiology</option>
              <option value>Biomedical Engineering</option>
            </select>
          </label>
          <button type="button" class="submit">Sign Up</button>
          <button type="button" class="fb-btn">
            Join with
            <span>facebook</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      email: "g@g.com",
      password: "asdasd28"
    };
  },
  mounted() {
    document.querySelector(".img__btn").addEventListener("click", function() {
      document.querySelector(".cont").classList.toggle("s--signup");
    });
  },
  methods: {
    loginProcess() {
      if (this.password && this.email) {
        const password = this.password;
        const email = this.email;
        fetch("userLogin", {
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": this.token
          },
          method: "post",
          body: JSON.stringify({
            query_id: "mKrTyR2e456",
            email: email,
            password: password
          })
        })
          .then(response => response.json())
          .then(data => {
            if (data.result === "success") {
              window.location.assign("/");
            }
          })
          .catch(err => {
            console.error("Warning:", err);
          });
      }
    }
  },
  computed: {
    token: function() {
      return this.$store.getters.getToken;
    }
  }
};
</script>

<style lang="scss" scoped>
*,
*:before,
*:after {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: "Open Sans", Helvetica, Arial, sans-serif;
  background: #ededed;
}

input,
button {
  border: none;
  outline: none;
  background: none;
  font-family: "Open Sans", Helvetica, Arial, sans-serif;
}

$contW: 100%;
$imgW: 50%;
$formW: $contW - $imgW;
$switchAT: 1.2s;

$inputW: 50%;
$btnH: 36px;

$diffRatio: ($contW - $imgW) / $contW;

@mixin signUpActive {
  .cont.s--signup & {
    @content;
  }
}

.tip {
  font-size: 20px;
  margin: 40px auto 50px;
  text-align: center;
}

.cont {
  overflow: hidden;
  position: relative;
  width: $contW;
  height: 100vh;
  margin: 0 auto 100px;
  background: #fff;
}

.form {
  position: relative;
  width: $formW;
  height: 100%;
  transition: transform $switchAT ease-in-out;
  padding: 50px 30px 0;
}

.sub-cont {
  overflow: hidden;
  position: absolute;
  left: $formW;
  top: 0;
  width: $contW;
  height: 100%;
  padding-left: $imgW;
  background: #fff;
  transition: transform $switchAT ease-in-out;

  @include signUpActive {
    transform: translate3d($formW * -1, 0, 0);
  }
}

button {
  display: block;
  margin: 0 auto;
  width: $inputW;
  height: $btnH;
  border-radius: 30px;
  color: #fff;
  font-size: 15px;
  cursor: pointer;
}

.img {
  overflow: hidden;
  z-index: 2;
  position: absolute;
  left: 0;
  top: 0;
  width: $imgW;
  height: 100%;
  padding-top: 360px;

  &:before {
    content: "";
    position: absolute;
    right: 0;
    top: 0;
    width: $contW;
    height: 100%;
    background-image: url("../../../public/images/stethoscope-white-first-aid-kit-medical-equipment-blank-blue-background_23-2147874872.jpg");
    background-size: cover;
    background-repeat: inherit;
    transition: transform $switchAT ease-in-out;
  }

  &:after {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
  }

  @include signUpActive {
    &:before {
      transform: translate3d($formW, 0, 0);
    }
  }

  &__text {
    z-index: 2;
    position: absolute;
    left: 0;
    top: 50px;
    width: 100%;
    padding: 0 20px;
    text-align: center;
    color: #fff;
    transition: transform $switchAT ease-in-out;

    h2 {
      margin-bottom: 10px;
      font-weight: normal;
    }

    p {
      font-size: 14px;
      line-height: 1.5;
    }

    &.m--up {
      @include signUpActive {
        transform: translateX($imgW * 2);
      }
    }

    &.m--in {
      transform: translateX($imgW * -2);

      @include signUpActive {
        transform: translateX(0);
      }
    }
  }

  &__btn {
    overflow: hidden;
    z-index: 2;
    position: relative;
    width: 100px;
    height: $btnH;
    margin: 0 auto;
    background: transparent;
    color: #fff;
    text-transform: uppercase;
    font-size: 15px;
    cursor: pointer;

    &:after {
      content: "";
      z-index: 2;
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      border: 2px solid #fff;
      border-radius: 30px;
    }

    span {
      position: absolute;
      left: 0;
      top: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 100%;
      transition: transform $switchAT;

      &.m--in {
        transform: translateY($btnH * -2);

        @include signUpActive {
          transform: translateY(0);
        }
      }

      &.m--up {
        @include signUpActive {
          transform: translateY($btnH * 2);
        }
      }
    }
  }
}

h2 {
  width: 100%;
  font-size: 26px;
  text-align: center;
}

label {
  display: block;
  width: $inputW;
  margin: 30px auto 0;
  text-align: center;

  span {
    font-size: 12px;
    color: #cfcfcf;
    text-transform: uppercase;
  }
}

input {
  display: block;
  width: 100%;
  margin-top: 5px;
  padding-bottom: 5px;
  font-size: 16px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.4);
  text-align: center;
}

.forgot-pass {
  margin-top: 35px;
  text-align: center;
  font-size: 13px;
  color: #ccc;
  cursor: default;
}

.submit {
  margin-top: 40px;
  margin-bottom: 20px;
  text-transform: uppercase;
}

.submit {
  border: 1px solid transparent;
  height: 40px;
  background-color: #3089f1;
  color: #fff;
  border-radius: 20px;
}

.submit:hover {
  border: 1px solid #3089f1;
  background-color: #fff;
  color: #3089f1;
}

.fb-btn {
  border: 1px solid #3089f1;
  color: #3089f1;
  height: 40px;

  &:hover {
    border: 1px solid transparent;
    height: 40px;
    background-color: #3089f1;
    color: #fff;
  }

  span {
    font-weight: bold;
    color: darken(#768cb6, 20%);
  }
}

.sign-in {
  transition-timing-function: ease-out;

  @include signUpActive {
    transition-timing-function: ease-in-out;
    transition-duration: $switchAT;
    transform: translate3d($formW, 0, 0);
  }
}

.sign-up {
  width: 100%;
  transform: translate3d($contW * -1, 0, 0);

  @include signUpActive {
    transform: translate3d(0, 0, 0);
  }
}

.icon-link {
  position: absolute;
  left: 5px;
  bottom: 5px;
  width: 32px;

  img {
    width: 100%;
    vertical-align: top;
  }

  &--twitter {
    left: auto;
    right: 5px;
  }
}

.login {
  .headerText {
    margin-bottom: 40px;
  }

  .advertText {
    font-size: 15px;
    font-family: Arial, Helvetica, sans-serif;
  }

  .formInputField {
    border: 1px solid #ccc;
    text-align: left;
    border-radius: 3px;
    padding: 7px 10px;
  }

  .chooseDept {
    width: 100%;
    padding: 7px 10px;
    font-size: 15px;
    border: 1px solid #ccc;
    border-radius: 1px;
    outline: none;
  }

  .mpn {
    font-family: Arial, Helvetica, sans-serif;
  }
}
</style>
