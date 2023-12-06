import { logOut } from '@lib/auth/logOut'
import { getUser } from '@lib/users/getUser'

const user = await getUser(localStorage.getItem('user_id') ?? '0')

if(user?.status == 404 && localStorage.getItem('user_id')) {
  logOut()
}