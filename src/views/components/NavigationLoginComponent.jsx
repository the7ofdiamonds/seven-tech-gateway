import React from 'react';

function NavigationLoginComponent(props) {
  const { page } = props;

  const handleLogin = () => {
    window.location.href = `/login`;
  };

  const handleSignUp = () => {
    window.location.href = `/signup`;
  };

  const handleForgot = () => {
    window.location.href = `/forgot`;
  };

  return (
    <>
      <div className="options">
        {page === 'login' ? (
          ''
        ) : (
          <button onClick={handleLogin} id="login_btn">
            <h3>LOGIN</h3>
          </button>
        )}

        {page === 'signup' ? (
          ''
        ) : (
          <button onClick={handleSignUp} id="signup_btn">
            <h3>SIGN UP</h3>
          </button>
        )}

        {page === 'forgot' ? (
          ''
        ) : (
          <button onClick={handleForgot} id="forgot_btn">
            <h3>FORGOT</h3>
          </button>
        )}
      </div>
    </>
  );
}

export default NavigationLoginComponent;
