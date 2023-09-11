import { isValidSession } from '@lib/auth/sessions/isValidSession'
import { logOut } from '@lib/auth/logOut'

console.log(location.href)

if (
  !location.href.startsWith('http://localhost:3000/auth') &&
  !(await isValidSession())
) {
  logOut()
}

if (
  location.href === 'http://localhost:3000/auth' &&
  (await isValidSession())
) {
  location.href = 'http://localhost:3000'
}
