export interface User {
  id_user: string
  username: string
  display_name: string
  password: string
  email: string
  avatar: string
  created_at: string
  links: string[]
  status?: number
}