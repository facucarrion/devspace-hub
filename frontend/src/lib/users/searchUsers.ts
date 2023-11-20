export async function searchUsers(name: string) {
  const response = await fetch(`http://127.0.0.1:8080/api/users/search/${name}`);
  const data = await response.json();
  console.log(data)
  return data;
}