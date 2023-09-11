import { decodeJWT } from "../../lib/auth/jwt/decode";
  
const token = localStorage.getItem('jwt')
const ownUser = await decodeJWT({ token: token })
  
console.log('q')
  
if (user.user_id === ownUser?.user_id) {
  Astro.redirect('/profile')
}