import axios from "axios";

export async function UserGet(
	schoolId = 0,
	search= "",
	paginate= "1",
	page= 1
) {
  try {
    let result = await axios.get(`
    	http://127.0.0.1:8000/api/users?school=${schoolId}&search=${search}&paginate=${paginate}&page=${page}
    `);
    if (result) {
      return result;
    }
  } catch (error) {
    console.error(error);
    throw error;
  }
}
