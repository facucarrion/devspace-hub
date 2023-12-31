export interface Project {
  id_project: string
  title: string
  description: string
  url: string
  image: string
  logo: string
  upvotes: string
  created_at: string
  creator_id: string
  creator_username: string
  creator_avatar: string
  collaborators: {
    username: string
    avatar: string
    is_editor: string
  }[]
  links: string[]
  tags: string[]
  status?: number
}