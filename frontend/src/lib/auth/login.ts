interface LoginProps {
  email: string
  password: string
}

export async function login({ email, password }: LoginProps) {
  const response = await fetch('http://127.0.0.1:8080/api/auth/login', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ email, password }),
  })

  const data = await response.json()

  localStorage.setItem('jwt', data.token)
  localStorage.setItem('jwt_secret', data.user.password)
  localStorage.setItem('user_id', data.user.id_user)

  return response
}