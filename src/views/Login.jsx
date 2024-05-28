import { useEffect } from 'react';
import { useSelector } from 'react-redux';

import LoginComponent from './components/LoginComponent';
import NavigationLoginComponent from './components/NavigationLoginComponent';

function Login() {
  let page = 'login';

  const { loginStatusCode } = useSelector((state) => state.login);

  // useEffect(() => {
  //   if (loginStatusCode == 200) {
  //     const urlParams = new URLSearchParams(window.location.search);
  //     const redirectTo = urlParams.get('redirectTo');

  //     setTimeout(() => {
  //       if (redirectTo == null) {
  //         window.location.href = '/dashboard';
  //       } else {
  //         window.location.href = redirectTo;
  //       }
  //     }, 5000);
  //   }
  // }, [loginStatusCode]);

  useEffect(() => {
    if (loginStatusCode == 404) {
      setTimeout(() => {
        window.location.href = '/signup';
      }, 5000);
    }
  }, [loginStatusCode]);

  return (
    <>
      <main className="login">
        <NavigationLoginComponent page={page} />
        <LoginComponent />
      </main>
    </>
  );
}

export default Login;
