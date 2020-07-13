require "csv"

class CSVLoad
  def load
    pref_hash = {}
    CSV.foreach("KEN_ALL.CSV") do |row|
      row[6] row[7]
    end

  end
end

CSVLoad.new.load