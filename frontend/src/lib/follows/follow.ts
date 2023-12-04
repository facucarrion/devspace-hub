export const follow = async (id_user_followed: string, id_user_follower:string) => {
  const response = await fetch('http://127.0.0.1:8080/api/follows', {
    method: 'POST',
    body: JSON.stringify({
      id_user_followed,
      id_user_follower
    })
  })
  const data = await response.json()
  return data
}