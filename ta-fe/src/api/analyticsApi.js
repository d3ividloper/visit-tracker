import axios from "axios";

export async function fetchHourlyVisits() {
    const response = await axios.get('/api/dashboard/hourly-visits');
    return response.data;
}