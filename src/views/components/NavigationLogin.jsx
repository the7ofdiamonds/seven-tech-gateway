function NavigationLoginComponent() {
  const baseHost = window.location.protocol + '//' + window.location.host;

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
        <button onClick={handleLogin}>
          <h3>LOGIN</h3>
        </button>

        <button onClick={handleSignUp}>
          <h3>SIGN UP</h3>
        </button>

        <button onClick={handleForgot}>
          <h3>FORGOT</h3>
        </button>
      </div>
    </>
  );
}

export default NavigationLoginComponent;
