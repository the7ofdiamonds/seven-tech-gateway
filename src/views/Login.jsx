import LoginComponent from './components/LoginComponent';

function Login() {
  let page = 'login';

  const { accessToken, refreshToken } = useSelector((state) => state.login);

  useEffect(() => {
    if (accessToken && refreshToken) {
      const urlParams = new URLSearchParams(window.location.search);
      const redirectTo = urlParams.get('redirectTo');

      setTimeout(() => {
        if (redirectTo == null) {
          window.location.href = '/dashboard';
        } else {
          window.location.href = redirectTo;
        }
      }, 5000);
    }
  }, [accessToken, refreshToken]);

  return (
    <>
      <LoginComponent />
    </>
  );
}

export default LoginComponent;
