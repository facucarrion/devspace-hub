export async function getFollowsCount(id: string) {
  const response = await fetch(`http://127.0.0.1:8080/api/follows/count/${id}`)
  const data = await response.json()
  
  return {
    followers: +data.followers,
    followings: +data.followings
  }
}